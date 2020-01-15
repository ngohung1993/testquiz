<?php

namespace common\helpers;

use common\models\AccountBank;
use common\models\Classroom;
use common\models\ClassroomDetail;
use common\models\Room;
use common\models\Subject;
use common\models\TransactionHistory;
use Yii;
use yii\helpers\Url;
use yii\helpers\Html;
use common\models\Tab;
use common\models\Unit;
use common\models\User;
use common\models\Post;
use common\models\Page;
use yii\data\Pagination;
use common\models\Topic;
use common\models\Exam;
use common\models\Setting;
use common\models\Question;
use common\models\District;
use common\models\Province;
use common\models\Category;
use common\models\UserExam;
use common\models\Supporter;
use common\models\Utilities;
use common\models\GeneralInformation;
use yii\web\NotFoundHttpException;

class FunctionHelper
{

    /**
     * @param $str
     *
     * @return mixed|string
     */
    public static function slug($str)
    {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);

        return $str;
    }

    /**
     * @param $file
     */
    public static function download($file)
    {
        if (file_exists($file)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file));
            readfile($file);
            exit;
        }
    }

    /**
     * @param int $display_homepage
     * @param int $featured
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function get_categories($display_homepage = 0, $featured = 0)
    {
        $query = Category::find()
            ->joinWith('page')
            ->joinWith('seoTool')
            ->joinWith('posts')
            ->joinWith('products')
            ->joinWith('albums')
            ->where([' = ', 'category.status', 1]);

        $query->andWhere(['=', 'category.display_homepage', $display_homepage]);
        $query->andWhere(['=', 'category.featured', $featured]);

        return $query->all();
    }

    public $categories_id = [];

    /**
     * @param $categories
     * @param $category_id
     *
     * @return array
     */
    public function get_all_categories_id_children($categories, $category_id)
    {
        $cate_child = array();
        foreach ($categories as $key => $item) {
            if ($item['parent_id'] == $category_id) {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }

        if ($cate_child) {
            foreach ($cate_child as $key => $item) {
                $this->categories_id[] = $item['id'];
                FunctionHelper::get_all_categories_id_children($categories, $item['id']);
            }
        }

        return $this->categories_id;
    }

    /**
     * @param $slug
     * @param int $display_homepage
     * @param int $featured
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function get_category($slug, $display_homepage = 0, $featured = 0)
    {
        $query = Category::find()
            ->joinWith('page')
            ->joinWith('seoTool')
            ->joinWith('posts')
            ->joinWith('products')
            ->joinWith('albums')
            ->where(['=', 'category.status', 1])
            ->andWhere(['=', 'category.slug', $slug]);

        $query->andWhere(['=', 'display_homepage', $display_homepage]);
        $query->andWhere(['=', 'featured', $featured]);

        return $query->one();
    }

    public static function get_category_id($id)
    {
        $query = Category::find()
            ->joinWith('seoTool')
            ->where(['=', 'category.status', 1])
            ->andWhere(['=', 'category.type', Category::TOPIC])
            ->andWhere(['=', 'category.id', $id]);

        return $query->one();
    }

    public static function get_tab_by_category_slug($categoey_slug, $limit = null)
    {
        $category = Category::find()->where(['=', 'slug', $categoey_slug])->one();
        $query = Tab::find()
            ->joinWith('images0')
            ->where(['=', 'tab.status', 0])->andWhere(['=', 'tab.category_id', $category['id']]);
        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->all();
    }

    /**
     * @param null $parent_id
     * @param null $limit
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_categories_by_parent_id($parent_id = null, $limit = null)
    {
        $query = Category::find()
            ->where(['=', 'category.status', 1]);

        if ($parent_id) {
            $query->andWhere(['=', 'category.parent_id', $parent_id]);
        } else {
            $query->andWhere(['is', 'category.parent_id', null]);
        }
        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->orderBy('serial ASC')->all();
    }

    /**
     * @param $page_key
     * @param null $limit
     * @param null $display_homepage
     * @param null $featured
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function get_categories_by_page_key($page_key, $limit = null, $display_homepage = null, $featured = null)
    {
        $page = Page::find()->where(['=', 'key', $page_key])->one();

        $query = Category::find()
            ->joinWith('page')
            ->joinWith('seoTool')
            ->joinWith('posts')
            ->joinWith('products')
            ->joinWith('albums')
            ->where(['=', 'category.status', '1'])
            ->andWhere(['=', 'category.page_id', $page['id']]);

        if ($display_homepage) {
            $query->andWhere(['=', 'category.display_homepage', $display_homepage]);
        }

        if ($featured) {
            $query->andWhere(['=', 'category.featured', $featured]);
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->all();
    }

    /**
     * @param $id
     * @param null $limit
     *
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_tab_by_post_id($id, $limit = null)
    {
        $query = Tab::find()
            ->where(['=', 'tab.status', 0])->andWhere(['=', 'post_id', $id]);
        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->all();
    }

    /**
     * @param $slug
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function get_category_by_slug($slug)
    {
        $query = Category::find()
            ->joinWith('seoTool')
            ->joinWith('posts')
            ->where(['=', 'category.slug', $slug])
            ->andWhere(['=', 'category.status', 1]);

        return $query->one();
    }

    public static function get_class_by_slug($slug)
    {
        $query = Classroom::find()->where(['slug' => $slug])->andWhere(['status' => 1])->one();
        if ($query) {
            return $query;

        } else {
            throw new NotFoundHttpException('The requested page does not exist . ');
        }

    }

    public static function get_subject_by_slug($slug)
    {
        $query = Subject::find()->where(['slug' => $slug])->andWhere(['status' => 1])->one();
        if ($query) {
            return $query;

        } else {
            throw new NotFoundHttpException('The requested page does not exist . ');
        }

    }

    public static function get_topic_by_slug($slug)
    {
        $query = Topic::find()->where(['slug' => $slug])->andWhere(['display' => 1])->andWhere(['status' => Topic::DUYET])->andWhere(['active' => Topic::ACTIVE])->one();
        if ($query) {
            return $query;

        } else {
            throw new NotFoundHttpException('The requested page does not exist . ');
        }

    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function get_provinces()
    {
        $provinces = Province::find()->all();

        return $provinces;
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function get_districts()
    {
        $districts = District::find()->all();

        return $districts;
    }

    /**
     * @param $province_id
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function get_districts_by_province_id($province_id)
    {
        $districts = District::find()->where(['province_id' => $province_id])->all();

        return $districts;
    }

    /**
     * @param $categories
     * @param int $parent_id
     */
    public static function show_categories_nestable($categories, $parent_id = 0)
    {
        $cate_child = array();
        foreach ($categories as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }

        usort($cate_child, function ($a, $b) {
            return $a['serial'] > $b['serial'];
        });

        if ($cate_child) {
            echo '<ol class="dd-list">';
            foreach ($cate_child as $key => $item) {
                echo '<li class="dd-item" data-id="' . $item['id'] . '"><div class="dd-handle">' . $item['title'] . '</div > ';
                FunctionHelper::show_categories_nestable($categories, $item['id']);
                echo '</li>';
            }
            echo '</ol>';
        }
    }

    /**
     * @param $utilities
     * @param int $parent_id
     */
    public static function show_utilities_nestable($utilities, $parent_id = 0)
    {
        $cate_child = array();
        foreach ($utilities as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $cate_child[] = $item;
                unset($utilities[$key]);
            }
        }

        usort($cate_child, function ($a, $b) {
            return $a['serial'] > $b['serial'];
        });

        if ($cate_child) {
            echo '<ol class="dd-list">';
            foreach ($cate_child as $key => $item) {
                echo '<li class="dd-item" data-id="' . $item['id'] . '"><div class="dd-handle">' . $item['title'] . '</div > ';
                FunctionHelper::show_utilities_nestable($utilities, $item['id']);
                echo '</li>';
            }
            echo '</ol>';
        }
    }

    /**
     * @param $categories
     * @param $selected
     * @param int $parent_id
     * @param string $serial
     */
    public static function show_categories_select($categories, $selected = null, $parent_id = 0, $serial = '')
    {

        $cate_child = array();
        foreach ($categories as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }

        usort($cate_child, function ($a, $b) {
            return $a['serial'] > $b['serial'];
        });

        if ($cate_child) {

            foreach ($cate_child as $key => $item) {
                echo '<option ' . ($selected == $item['id'] ? 'selected="selected"' : '') . ' value="' . $item['id'] . '">';
                echo $serial . $item['serial'] . ' ' . $item['title'];
                echo '</option>';
                FunctionHelper::show_categories_select($categories, $selected, $item['id'], $item['serial'] . $serial . '.');
            }
        }
    }

    /**
     * @param $categories
     * @param int $parent_id
     * @param string $serial
     */
    public static function show_categories_table($categories, $parent_id = 0, $serial = '')
    {
        $cate_child = array();
        foreach ($categories as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }

        usort($cate_child, function ($a, $b) {
            return $a['serial'] > $b['serial'];
        });

        if ($cate_child) {
            foreach ($cate_child as $key => $item) {
                $dot = $serial == '' ? $item['serial'] : $serial . '.' . $item['serial'];
                echo '<tr>';
                echo '<td>';
                echo '<input title="" data-id="' . $item['id'] . '" type="checkbox" class="minimal">';
                echo '</td>';
                echo '<td>' . ++$key . '</td>';
                echo '<td>' . $item['title'] . '</td>';
                echo '<td><img src="' . $item['avatar'] . '" alt="' . $item['title'] . '"></td>';
                echo '<td>';
                echo '<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini" style="border:none">';
                echo '<input data-id="' . $item['id'] . '" data-api="ajax/enable-column" data-column="status" data-table="category" type="checkbox" ' . ($item['status'] ? 'checked="checked"' : '') . ' title="" name="switch-checkbox">';
                echo '</div></td>';
                echo '<td class="text-center"><div class="table-actions"><a class="btn btn-icon btn-sm btn-primary tip" href="' . Url::to([
                        'category/update',
                        'id' => $item['id']
                    ]) . '"><i class="fa fa-edit"></i></a>' .
                    Html::a(Yii::t('backend', '<i class="fa fa-trash-o"></i>'), ['delete', 'id' => $item->id], [
                        'class' => 'btn btn-icon btn-sm btn-danger tip',
                        'data' => [
                            'confirm' => Yii::t('backend', 'Bạn có chắc chắn muốn xóa?'),
                            'method' => 'post',
                        ],
                    ]) . '</div></td>';
                echo '</tr> ';
                FunctionHelper::show_categories_table($categories, $item['id'], $dot);
            }
        }
    }

    /**
     * @param $utilities
     * @param int $parent_id
     * @param string $serial
     */
    public static function show_utilities_table($utilities, $parent_id = 0, $serial = '')
    {
        $cate_child = array();
        foreach ($utilities as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $cate_child[] = $item;
                unset($utilities[$key]);
            }
        }

        usort($cate_child, function ($a, $b) {
            return $a['serial'] > $b['serial'];
        });

        if ($cate_child) {
            foreach ($cate_child as $key => $item) {
                $dot = $serial == '' ? $item['serial'] : $serial . '.' . $item['serial'];
                echo '<tr>';
                echo '<td>';
                echo '<input title="" data-id="' . $item['id'] . '" type="checkbox" class="minimal">';
                echo '</td>';
                echo '<td>' . $dot . '</td>';
                echo '<td>' . $item['icon'] . '</td>';
                echo '<td><a href="#" class="editable" data-name="utilities#title" data-type="text"
                                               data-pk="' . $item['id'] . '" data-title="Nhập tiêu đề" data-url="' . Url::to(['ajax/edit-column']) . '">' . $item['title'] . '</a></td>';
                echo '<td>' . ($item['permission'] == User::ROLE_ADMIN ? 'Cao cấp' : 'Mọi người') . '</td>';
                echo '<td>';
                echo '<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-mini" style="border:none">';
                echo '<input data-id="' . $item['id'] . '" data-api="ajax/enable-column" data-column="status" data-table="category" type="checkbox" ' . ($item['status'] ? 'checked="checked"' : '') . ' title="" name="switch-checkbox">';
                echo '</div></td>';
                echo '<td class="text-center"><div class="table-actions"><a class="btn btn-icon btn-sm btn-primary tip" href="' . Url::to([
                        'category/update',
                        'id' => $item['id']
                    ]) . '"><i class="fa fa-edit"></i></a>' .
                    Html::a(Yii::t('backend', '<i class="fa fa-trash-o"></i>'), ['delete', 'id' => $item->id], [
                        'class' => 'btn btn-icon btn-sm btn-danger tip',
                        'data' => [
                            'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
                            'method' => 'post',
                        ],
                    ]) . '</div></td>';
                echo '</tr> ';
                FunctionHelper::show_utilities_table($utilities, $item['id'], $dot);
            }
        }
    }

    /**
     * @param int $parent_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function category_group_product($parent_id = null)
    {
        $query = Category::find()
            ->where(['parent_id' => $parent_id])
            ->orderBy('id DESC')
            ->all();
        return $query;
    }

    /**
     * @param $utilities
     */
    public static function show_utilities_menu($utilities)
    {

        usort($utilities, function ($a, $b) {
            return $a['serial'] > $b['serial'];
        });

        foreach ($utilities as $key => $item) {

            $util_child = FunctionHelper::get_utilities_by_parent_id(null, $item['id']);

            usort($util_child, function ($a, $b) {
                return $a['serial'] > $b['serial'];
            });

            if ($util_child) {
                echo '<li class="nav-item has-ul">';
                echo '<a href="" class="nav-link nav-toggle">';
                echo '<i class="' . $item['icon'] . '"></i >';
                echo '<span class="title" >' . $item['title'] . '</span>';
                echo '<span class="arrow"></span>';
                echo '</a>';
                echo '<ul class="sub-menu hidden-ul">';
                foreach ($util_child as $key_child => $item_child) {
                    echo '<li class="nav-item">';
                    echo '<a href="' . Url::to([$item_child['path']]) . '" class="nav-link">';
                    echo '<i class="' . $item_child['icon'] . '"></i >';
                    echo '<span class="title"> ' . $item_child['title'] . '</span>';
                    echo '</a>';
                    echo ' </li>';
                }
                echo '</ul>';
                echo '</li>';
            } else {
                echo '<li class="nav-item">';
                echo '<a href="' . Url::to([$item['path']]) . '" class="nav-link nav-toggle">';
                echo '<i class="' . $item['icon'] . '"></i >';
                echo '<span class="title">' . $item['title'] . '</span>';
                echo '</a>';
                echo ' </li>';
            }
        }
    }

    /**
     * @param null $parent_id
     * @param null $permission
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function get_utilities_by_parent_id($permission = null, $parent_id = null)
    {
        $query = Utilities::find();

        if ($parent_id) {
            $query->where(['parent_id' => $parent_id]);
        } else {
            $query->where(['is', 'parent_id', null]);
        }

        if ($permission) {
            $query->andWhere(['=', 'permission', $permission]);
        }

        $utilities = $query->all();

        return $utilities;
    }

    /**
     * @param $categories
     * @param int $parent_id
     * @param string $serial
     */
    public static function show_categories_of_post_table($categories, $parent_id = 0, $serial = '')
    {
        $cate_child = array();
        foreach ($categories as $key => $item) {
            if ($item['parent_id'] == $parent_id) {
                $cate_child[] = $item;
                unset($categories[$key]);
            }
        }

        usort($cate_child, function ($a, $b) {
            return $a['serial'] > $b['serial'];
        });

        if ($cate_child) {
            foreach ($cate_child as $key => $item) {
                echo '<tr>';
                echo '<td>' . ($serial == '' ? $serial : $serial . '.') . $item['serial'] . '</td>';
                echo '<td><a href="' . Url::to([
                        'post/post-of-category',
                        'category_slug' => $item['slug']
                    ]) . '">' . $item['title'] . '</a></td>';
                echo '<td>' . $item['code'] . '</td>';
                echo '</tr> ';
                FunctionHelper::show_categories_of_post_table($categories, $item['id'], ($serial == '' ? $serial : $serial . '.') . $item['serial']);
            }
        }

    }

    /**
     * @param null $limit
     * @param null $display_homepage
     * @param null $featured
     *
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function get_posts($limit = null, $display_homepage = null, $featured = null)
    {
        $query = Post::find()
            ->joinWith('category')
            ->joinWith('seoTool')
            ->joinWith('images0')
            ->joinWith('albums')
            ->where([' = ', 'post.status', 1]);

        if ($display_homepage) {
            $query->andWhere([' = ', 'display_homepage', $display_homepage]);
        }

        if ($featured) {
            $query->andWhere([' = ', 'featured', $featured]);
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->all();
    }

    /**
     * @param $slug
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function get_post_by_slug($slug)
    {
        $query = Post::find()
            ->joinWith('category')
            ->joinWith('seoTool')
            ->joinWith('images0')
            ->where(['=', 'post.status', 1])
            ->andWhere(['=', 'post.slug', $slug]);

        return $query->one();
    }


    public static function get_classified_by_slug($slug)
    {
        $query = Classified::find()
            ->joinWith('category')
            ->joinWith('seoTool')
            ->joinWith('images0')
            ->where(['=', 'classified.status', 1])
            ->andWhere(['=', 'classified.slug', $slug]);

        return $query->one();
    }

    /**
     * @param $category_slug
     * @param null $limit
     * @param null $display_homepage
     * @param null $featured
     *
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_post_by_category_slug($category_slug, $limit = null, $display_homepage = null, $featured = null)
    {
        $category = Category::find()->where(['slug' => $category_slug])->one();

        $query = Post::find()
            ->joinWith('category')
            ->joinWith('seoTool')
            ->joinWith('images0')
            ->where(['post.status' => 1])
            ->andWhere(['post.category_id' => $category['id']]);

        if ($display_homepage) {
            $query->andWhere(['display_homepage' => $display_homepage]);
        }

        if ($display_homepage) {
            $query->andWhere(['featured' => $featured]);
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->all();
    }

    public static function get_post_desc($limit = null, $display_homepage = null, $featured = null)
    {

        $query = Post::find()
            ->joinWith('category')
            ->joinWith('seoTool')
            ->joinWith('images0')
            ->joinWith('albums')
            ->where(['post.status' => 1]);

        if ($display_homepage) {
            $query->andWhere(['post.display_homepage' => $display_homepage]);
        }

        if ($featured) {
            $query->andWhere(['post.featured' => $featured]);
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->orderBy('id desc')->all();
    }

    /**
     * @param null $limit
     * @param null $display_homepage
     * @param null $featured
     * @return array
     */
    public static function get_post($limit = null, $display_homepage = null, $featured = null)
    {

        $query = Post::find()
            ->joinWith('category')
            ->joinWith('seoTool')
            ->joinWith('images0')
            ->where(['post.status' => 1]);

        if ($display_homepage) {
            $query->andWhere(['post.display_homepage' => $display_homepage]);
        }

        if ($featured) {
            $query->andWhere(['post.featured' => $featured]);
        }

        if ($limit) {
            $query->limit($limit);
        }
        $pagination = new Pagination([
            'defaultPageSize' => 5,
            'totalCount' => $query->count(),
        ]);

        $posts = $query->offset($pagination->offset)->limit($pagination->limit)
            ->orderBy('id DESC')
            ->all();

        return [
            'posts' => $posts,
            'pages' => $pagination,
        ];
    }

    public static function get_classifies($limit = null, $display_homepage = null, $featured = null)
    {
        $query = Classified::find()
            ->where(['classified.status' => 1]);

        if ($display_homepage) {
            $query->andWhere(['classified.display_homepage' => $display_homepage]);
        }

        if ($featured) {
            $query->andWhere(['classified.featured' => $featured]);
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->orderBy('id desc')->all();
    }

    public static function get_classifieds($limit = null, $display_homepage = null, $featured = null)
    {
        /*$pagination = null;*/
        $query = Classified::find()
            ->where(['classified.status' => 1]);

        if ($display_homepage) {
            $query->andWhere(['classified.display_homepage' => $display_homepage]);
        }

        if ($featured) {
            $query->andWhere(['classified.featured' => $featured]);
        }

        if ($limit) {
            $query->limit($limit);
        }
        $pagination = new Pagination([
            'defaultPageSize' => 9,
            'totalCount' => $query->count(),
        ]);

        $search = $query->offset($pagination->offset)->limit($pagination->limit)
            ->orderBy('id DESC')
            ->asArray()->all();

        return [
            'search' => $search,
            'pages' => $pagination,
        ];
    }


    /**
     * @param $slug
     *
     * @return \yii\db\ActiveQuery
     */
    public static function get_classified($slug)
    {
        $classified = Classified::find()
            ->joinWith('category')
            ->where(['classified.status' => 1])
            ->andWhere(['classified.slug' => $slug]);

        return $classified;
    }

    public static function get_unit_by_id($id)
    {
        $query = Unit::find()
            ->where(['id' => $id]);

        return $query->one();
    }

    /**
     * @param $category_slug
     * @param null $limit
     * @param null $display_homepage
     * @param null $featured
     *
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_classifieds_by_category_slug($category_slug, $limit = null, $display_homepage = null, $featured = null)
    {
        $category = Category::find()->where(['slug' => $category_slug])->one();

        $query = Classified::find()
            ->where(['classified.status' => 1])
            ->andWhere(['classified.category_id' => $category['id']]);

        if ($display_homepage) {
            $query->andWhere(['display_homepage' => $display_homepage]);
        }

        if ($display_homepage) {
            $query->andWhere(['featured' => $featured]);
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->all();
    }


    /**
     * @param int $limit
     * @param int $display_homepage
     * @param int $featured
     *
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_product_news($limit = null, $display_homepage = 0, $featured = 0)
    {
        $query = Product::find()
            ->joinWith('images0')
            ->where(['=', 'product.status', 1]);

        if ($display_homepage) {
            $query->andWhere(['=', 'product.display_homepage', $display_homepage]);
        }

        if ($featured) {
            $query->andWhere(['=', 'product.featured', $featured]);
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->orderBy('id DESC')->all();
    }

    /**
     * @param int $limit
     * @param int $display_homepage
     * @param int $featured
     *
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_product_featureds($limit = null, $display_homepage = 0, $featured = 0)
    {
        $query = Product::find()
            ->where(['=', 'product.status', 1]);

        if ($display_homepage) {
            $query->andWhere(['=', 'product.display_homepage', $display_homepage]);
        }

        if ($featured) {
            $query->andWhere(['=', 'product.featured', $featured]);
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->orderBy('views DESC')->all();
    }

    /**
     * @param $slug
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function get_product($slug)
    {
        return Product::find()->joinWith('category')
            ->joinWith('seoTool')
            ->joinWith('albums')
            ->joinWith('orderDetails')
            ->joinWith('images0')
            ->joinWith('user')
            ->where(['product.slug' => $slug])->one();
    }

    /**
     * @param $category_slug
     * @param null $limit
     * @param null $display_homepage
     * @param null $featured
     *
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_products_by_category_slug($category_slug, $limit = null, $display_homepage = null, $featured = null)
    {
        $category = Category::find()->where(['slug' => $category_slug])->one();

        $query = Product::find()
            ->joinWith('category')
            ->joinWith('seoTool')
            ->joinWith('albums')
            ->joinWith('orderDetails')
            ->joinWith('images0')
            ->joinWith('user')
            ->where(['product.status' => 1])
            ->andWhere(['product.category_id' => $category['id']]);

        if ($display_homepage) {
            $query->andWhere(['display_homepage' => $display_homepage]);
        }

        if ($display_homepage) {
            $query->andWhere(['featured' => $featured]);
        }

        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->all();
    }

    /**
     * @param $photo_location_key
     * @param null $limit
     *
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_images_by_photo_location_key($photo_location_key, $limit = null)
    {
        $photo_location = PhotoLocation::find()->where(['=', 'key', $photo_location_key])->one();

        $query = Image::find()
            ->where(['=', 'image.status', 1])
            ->andWhere(['=', 'image.photo_location_id', $photo_location['id']]);

        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->all();
    }

    /**
     * @param $key
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function get_setting_by_key($key)
    {
        $query = Setting::find()
            ->where(['=', 'setting.status', 1])
            ->andWhere(['=', 'setting.key', $key]);

        return $query->one();
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function get_supporter()
    {
        return Supporter::find()->where(['status' => 1])->all();
    }

    /**
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function get_general_information()
    {
        return GeneralInformation::find()->one();
    }

    /**
     * @param $setting_id
     * @param null $limit
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function get_tab_by_setting_id($setting_id, $limit = null)
    {
        $query = Tab::find()
            ->where(['=', 'tab.status', 0])
            ->andWhere(['=', 'tab.setting_id', $setting_id]);

        if ($limit) {
            $query->limit($limit);
        }

        return $limit == 1 ? $query->one() : $query->all();
    }

    /**
     * @param $serial
     *
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function get_category_by_serial($serial)
    {
        return Category::find()->where(['serial' => $serial])->one();
    }

    /**
     * @param $link
     * @param null $width
     * @param null $height
     * @param string $unit
     *
     * @return string
     */
    public static function get_frame_youtube_form_link($link, $width = null, $height = null, $unit = 'px')
    {

        $width = !$width ? '500px' : $width . $unit;
        $height = !$height ? '315px' : $height . 'px';

        $v = explode('?v=', $link);

        $frame = '<iframe width="' . $width . '" height="' . $height . '" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen src="https://www.youtube.com/embed/' . $v[1] . '"';

        $frame .= '></iframe>';

        return $frame;
    }

    /**
     * @param $fan_page
     *
     * @return string
     */
    public static function get_frame_facebook_form_link($fan_page)
    {

        $frame = '<div class="fb-page" data-href="' . $fan_page . '" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">';

        $frame .= '</div>';

        return $frame;
    }

    /**
     * @param $data
     * @param int $parent_id
     * @param string $str
     */
    public static function menuMulti($data, $parent_id = 0, $str = '|--')
    {
        foreach ($data as $key => $value) {

            if ($value['parent_id'] == $parent_id) {
                if ($value['parent_id'] == 0) {
                    echo '<option style="font-weight: bold; background: #f1f1f1;" value="' . $value['id'] . '" disabled>' . $value['title'] . '</option>';
                } else {
                    echo '<option style="color: #000" value="' . $value['id'] . '">' . '|--' . $value['title'] . '</option>';
                }

                unset($data[$key]);

                self::menuMulti($data, $value['id'], $str . ' | ' . $value['title']);
            }

        }
    }

    /**
     * @param $id
     * @param $status
     * @return int|string
     */
    public static function countStatusExamAdmin($id, $status)
    {
        $exams = Exam::find()->where(['topic_id' => $id])->andWhere(['status' => $status])->count();
        return $exams;
    }

    /**
     * @param $id
     * @param $status
     * @param $user
     * @return int|string
     */
    public static function countStatusExam($id, $status, $user)
    {
        $exams = Exam::find()->where(['topic_id' => $id])->andWhere(['status' => $status])->andWhere(['user_id' => $user])->andWhere(['exam.disable' => 1])->count();
        return $exams;
    }

    /**
     * @param $user_id
     * @param $status
     * @return int|string
     */
    public static function countStatusTopic($user_id, $status)
    {
        $topics = Topic::find()->where(['user_id' => $user_id])->andWhere(['status' => $status])->andWhere(['active' => Topic::ACTIVE])->count();
        return $topics;
    }

    /**
     * @param $exam_id
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getQuestionByExamId($exam_id)
    {
        return $questions = Question::find()->joinWith('examQuestions')->where(['exam_question.exam_id' => $exam_id])->asArray()->all();
    }

    /**
     * @param $topic_id
     * @return array
     */
    public static function get_exam_by_topic_id($topic_id)
    {
        $query = Exam::find()->joinWith('topic')->where(['exam.topic_id' => $topic_id])->andWhere(['exam.status' => Exam::DUYET]);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);
        $exams = $query->offset($pagination->offset)->limit($pagination->limit)
            ->orderBy('id DESC')->all();

        return [
            'exams' => $exams,
            'pages' => $pagination,
        ];
    }

    /**
     * @param $topic_id
     * @param null $limit
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_exam_by_topic_id_detail_page($topic_id, $limit = null)
    {
        $query = Exam::find()->joinWith('topic')->where(['exam.topic_id' => $topic_id])->andWhere(['exam.status' => Exam::DUYET]);
        if ($limit) {
            $query->limit($limit);
        }
        return $limit == 1 ? $query->one() : $query->orderBy('id DESC')->asArray()->all();
    }

    /**
     * @param null $user_id
     * @param $exam_id
     * @return array|null|\yii\db\ActiveRecord[]
     */
    public static function check_exam_bought_by_user_id($user_id = null, $exam_id)
    {
        if ($user_id == null) {
            return null;
        } else {
            return $user_exam = UserExam::find()->where(['user_id' => $user_id])->andWhere(['exam_id' => $exam_id])->andWhere(['type' => UserExam::BOUGHT])->asArray()->all();
        }
    }

    /**
     * @param $exam_id
     * @return int|string
     */
    public static function count_exam_bought($exam_id)
    {
        return $count = UserExam::find()->where(['exam_id' => $exam_id])->andWhere(['type' => UserExam::BOUGHT])->count();
    }

    /**
     * @param $time
     * @return string
     */
    public static function intToStringTimeFormat($time)
    {
        $arr = explode(':', $time);
        $min = ($arr[0] * 60) + ($arr[1]) + ($arr[2] > 30 ? 1 : 0);
        return $min . ' phút';
    }

    /**
     * @param $time
     * @return float|int
     */
    public static function get_time_exam($time)
    {
        $arr = explode(':', $time);
        $min = ($arr[0] * 60) + ($arr[1]) + ($arr[2] > 30 ? 1 : 0);
        return $min;
    }

    /**
     * @param $category_id
     * @return array
     */
    public static function get_class_by_category_id($category_id)
    {
        $result = [];

        $topic = Topic::find()->where(['status' => Topic::DUYET])
            ->andWhere(['display' => 1])
            ->andWhere(['active' => Topic::ACTIVE])
            ->andWhere(['category_id' => $category_id])
            ->asArray()->all();

        foreach ($topic as $key => $value) {
            $detail_classroom = ClassroomDetail::findOne($value['classroom_detail_id']);
            $classroom = Classroom::find()
                ->where(['id' => $detail_classroom['classroom_id']])
                ->andWhere(['status' => Classroom::ACTIVE])->one();

            if ($classroom) {
                $result[$classroom['id']] = $classroom;
            }
        }

        return $result;
    }

    /**
     * @param $category_id
     * @param null $limit
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_topic_by_category_id($category_id, $limit = null)
    {
        $topic = Topic::find()->where(['status' => Topic::DUYET])->andWhere(['display' => 1])->andWhere(['active' => Topic::ACTIVE])->andWhere(['category_id' => $category_id]);
        if ($limit) {
            $topic->limit($limit);
        }
        return $limit == 1 ? $topic->one() : $topic->all();
    }

    /**
     * @param null $limit
     * @return array
     */
    public static function get_exam_bought_new($limit = null)
    {
        $exams = [];
        $user_exam = UserExam::find()->where(['type' => UserExam::BOUGHT])->asArray()->orderBy('id DESC')->limit($limit)->asArray()->all();
        foreach ($user_exam as $key => $value) {
            $exam = Exam::findOne($value['exam_id']);
            $exams [] = $exam;
        }
        return $exams;
    }

    /**
     * @param null $limit
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_exam_new($limit = null)
    {
        $exams = Exam::find()->joinWith('topic')->where(['exam.status' => Exam::DUYET]);
        if ($limit) {
            $exams->limit($limit);
        }
        return $limit == 1 ? $exams->one() : $exams->orderBy('id DESC')->asArray()->all();
    }

    /**
     * @param null $limit
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_exam_hot($limit = null)
    {
        $exams = Exam::find()->joinWith('topic')->where(['exam.status' => Exam::DUYET]);
        if ($limit) {
            $exams->limit($limit);
        }
        return $limit == 1 ? $exams->one() : $exams->orderBy('count_bought DESC')->all();
    }

    /**
     * @param $status
     * @param $user
     * @return int|string
     */
    public static function countStatusExamUser($status, $user)
    {
        $exams = Exam::find()->joinWith('topic')->where(['topic.active' => Topic::ACTIVE])->andWhere(['exam.status' => $status])->andWhere(['exam.user_id' => $user])->andWhere(['exam.disable' => 1])->count();
        return $exams;

    }

    /**
     * @param $user
     * @return int|mixed
     */
    public static function countExamBuy($user)
    {
        $total = 0;
        $exams = Exam::find()->where(['user_id' => $user])->all();
        foreach ($exams as $value) {
            $total += $value['count_bought'];
        }
        return $total;
    }

    /**
     * @param $user_id
     * @return int|string
     */
    public static function countExamUser($user_id)
    {
        $count = Exam::find()->joinWith('topic')
            ->where(['topic.active' => Topic::ACTIVE])
            ->andWhere(['topic.status' => Topic::DUYET])
            ->andWhere(['exam.disable' => Exam::BLOCK])
            ->andWhere(['exam.status' => Exam::DUYET])
            ->andWhere(['exam.user_id' => $user_id])->count();

        return $count;
    }

    /**
     * @param $user_id
     * @return int|string
     */
    public static function countExamFreeUser($user_id)
    {
        $exams = Exam::find()->joinWith('topic')
            ->where(['topic.active' => Topic::ACTIVE])
            ->andWhere(['exam.disable' => Exam::BLOCK])
            ->andWhere(['exam.status' => Exam::DUYET])
            ->andWhere(['exam.user_id' => $user_id])
            ->andWhere(['exam.price' => 0])->count();
        return $exams;
    }

    /**
     * @param $user_id
     * @param $type
     * @return int|string
     */
    public static function countUserExamByType($user_id, $type)
    {
        $count = UserExam::find()->andWhere(['type' => $type])
            ->andWhere(['user_id' => $user_id])->count();
        return $count;
    }

    /**
     * @param $user_id
     * @return int|string
     */
    public static function count_exam_user($user_id)
    {
        $count = Exam::find()->joinWith('topic')
            ->where(['topic.active' => Topic::ACTIVE])
            ->andWhere(['exam.disable' => Exam::BLOCK])
            ->andWhere(['exam.status' => Exam::DUYET])
            ->andWhere(['exam.user_id' => $user_id])->count();
        return $count;
    }

    /**
     * @param $user_id
     * @return int|string
     */
    public static function countTopicUser($user_id)
    {
        $topics = Topic::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['status' => Topic::DUYET])
            ->andWhere(['active' => Topic::ACTIVE])
            ->count();
        return $topics;
    }

    /**
     * @param $topic_id
     * @param $user_id
     * @return int|string
     */
    public static function countExamTopic($topic_id, $user_id)
    {
        $counts = Exam::find()->where(['user_id' => $user_id])->andWhere(['topic_id' => $topic_id])->count();
        return $counts;
    }

    public static function countExamTopicAdmin($topic_id, $user_id)
    {
        $counts = Exam::find()->where(['user_id' => $user_id])->andWhere(['topic_id' => $topic_id])->andWhere(['<>', 'status', Exam::KHO_USER])->count();
        return $counts;
    }

    /**
     * @return array
     */
    public static function get_users_have_exam_bought_more()
    {
        $users = [];
        $result = [];
        $result[0] = [];

        $query = Exam::find()->joinWith('user')->where(['exam.status' => Exam::DUYET])->orderBy('count_bought DESC')->all();

        foreach ($query as $key => $value) {
            $users[$value['user']['id']] = $value['user'];
        }

        foreach ($users as $key => $value) {
            if (count($result[0]) > 4) {
                $result[1][] = $value;
            } else {
                $result[0][] = $value;
            }
        }
        return $result;
    }

    /**
     * @param $limit
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_user_make_exam_more($limit)
    {
        $query = Room::find()->joinWith('user')->select(['COUNT(user_id)', 'user_id'])->groupBy('room.user_id');
        if ($limit) {
            $query->limit($limit);
        }
        return $limit == 1 ? $query->one() : $query->orderBy('COUNT(user_id) DESC')->all();
    }

    /**
     * @return array
     */
    public static function get_topic_hot()
    {
        $topics = [];
        $query = Exam::find()->select(['COUNT(topic_id)', 'topic_id'])->where(['exam.status' => Exam::DUYET])->groupBy('topic_id')->limit(4)->orderBy('COUNT(topic_id) DESC')->all();
        foreach ($query as $key => $value) {
            $topic = Topic::findOne($value['topic_id']);
            $topics [] = $topic;
        }
        return $topics;
    }

    /**
     * @param $category_id
     * @param null $limit
     * @return array
     */
    public static function get_exam_by_category_id($category_id, $limit = null)
    {
        $query = Exam::find()
            ->innerJoin('topic', 'exam.topic_id = topic.id')
            ->innerJoin('category', 'topic.category_id = category.id')
            ->where(['exam.status' => Exam::DUYET])
            ->andWhere(['topic.status' => Topic::DUYET])
            ->andWhere(['topic.active' => Topic::ACTIVE])
            ->andWhere(['topic.display' => 1])
            ->andWhere(['category.id' => $category_id])
            ->andWhere(['exam.disable' => Exam::BLOCK])
            ->andWhere(['exam.admin_show_hide' => Exam::ADMIN_SHOW]);

        if ($limit) {
            $query->limit($limit);
        }

        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $query->count(),
        ]);

        $exams = $query->offset($pagination->offset)->limit($pagination->limit)
            ->orderBy('id DESC')
            ->all();

        return [
            'exams' => $exams,
            'pages' => $pagination,
        ];
    }

    /**
     * @param $category_id
     * @param null $limit
     * @return array
     */
    public static function get_exam_in_category_page_by_category_id($category_id, $limit = null)
    {
        $query = Exam::find()
            ->innerJoin('topic', 'exam.topic_id = topic.id')
            ->innerJoin('category', 'topic.category_id = category.id')
            ->innerJoin('classroom_detail', 'topic.classroom_detail_id = classroom_detail.id')
            ->innerJoin('classroom', 'classroom_detail.classroom_id = classroom.id')
            ->where(['exam.status' => Exam::DUYET])
            ->andWhere(['classroom.status' => Classroom::ACTIVE])
            ->andWhere(['topic.status' => Topic::DUYET])
            ->andWhere(['topic.active' => Topic::ACTIVE])
            ->andWhere(['topic.display' => 1])
            ->andWhere(['category.id' => $category_id])
            ->andWhere(['exam.disable' => Exam::BLOCK])
            ->andWhere(['exam.admin_show_hide' => Exam::ADMIN_SHOW]);

        if ($limit) {
            $query->limit($limit);
        }

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $exams = $query->offset($pagination->offset)->limit($pagination->limit)
            ->orderBy('id DESC')
            ->all();

        return [
            'exams' => $exams,
            'pages' => $pagination,
        ];
    }

    /**
     * @param $topic_id
     * @return bool|Subject|null
     */
    public static function get_subject_by_topic_id($topic_id)
    {
        $topic = Topic::findOne($topic_id);
        if ($topic) {
            return $subject = Subject::findOne(ClassroomDetail::findOne($topic['classroom_detail_id'])['subject_id']);
        } else {
            return false;
        }
    }

    /**
     * @param $topic_id
     * @return bool|Classroom|null
     */
    public static function get_classroom_by_topic_id($topic_id)
    {
        $topic = Topic::findOne($topic_id);
        if ($topic) {
            return $classroom = Classroom::findOne(ClassroomDetail::findOne($topic['classroom_detail_id'])['classroom_id']);
        } else {
            return false;
        }
    }

    /**
     * @param $user_id
     * @return bool|mixed
     */
    public static function get_user_by_user_id($user_id)
    {
        $user = User::findOne($user_id);
        if ($user) {
            return $user->name;
        } else {
            return false;
        }
    }

    public static function get_topic_id($topic_id)
    {
        $topic = Topic::findOne($topic_id);
        if ($topic) {
            return $topic->title;
        } else {
            return false;
        }
    }

    /**
     * @param $user_id
     * @return int|string
     */
    public static function count_number_took_exam_of_user_by_user_id($user_id)
    {
        return $query = Room::find()->where(['user_id' => $user_id])->count();
    }

    /**
     * @param $class_id
     * @return array
     */
    public static function get_subject_by_class_id($class_id)
    {
        $query = Subject::find()
            ->innerJoin('classroom_detail', 'classroom_detail.subject_id = subject.id')
            ->innerJoin('classroom', 'classroom_detail.classroom_id = classroom.id')
            ->where(['classroom.id' => $class_id])
            ->andWhere(['classroom.status' => Classroom::ACTIVE])->all();

        return $query;
    }

    /**
     * @param $class_id
     * @return array
     */
    public static function get_exam_by_class_id($class_id)
    {
        $query = Exam::find()->innerJoin('topic', 'exam.topic_id = topic.id')->innerJoin('classroom_detail', 'topic.classroom_detail_id = classroom_detail.id')->where(['exam.status' => Exam::DUYET])->andWhere(['topic.status' => Topic::DUYET])->andWhere(['topic.active' => Topic::ACTIVE])->andWhere(['topic.display' => 1])->andWhere(['classroom_detail.classroom_id' => $class_id]);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $exams = $query->offset($pagination->offset)->limit($pagination->limit)
            ->orderBy('id DESC')->all();

        return [
            'exams' => $exams,
            'pages' => $pagination,
        ];
    }

    /**
     * @param $subject_id
     * @return array
     */
    public static function get_topic_by_subject_id($subject_id)
    {
        $result = [];
        $query = ClassroomDetail::find()->where(['subject_id' => $subject_id])->asArray()->all();
        foreach ($query as $key => $value) {
            $topics = Topic::find()->where(['classroom_detail_id' => $value['id']])->andWhere(['display' => 1])->andWhere(['status' => Topic::DUYET])->andWhere(['active' => Topic::ACTIVE])->asArray()->all();
            foreach ($topics as $key_topic => $value_topic) {
                $result[] = $value_topic;
            }
        }
        return $result;
    }

    /**
     * @param $subject_id
     * @return array
     */
    public static function get_exam_by_subject_id($subject_id)
    {
        $query = Exam::find()->innerJoin('topic', 'exam.topic_id = topic.id')->innerJoin('classroom_detail', 'topic.classroom_detail_id = classroom_detail.id')->where(['exam.status' => Exam::DUYET])->andWhere(['topic.status' => Topic::DUYET])->andWhere(['topic.active' => Topic::ACTIVE])->andWhere(['topic.display' => 1])->andWhere(['classroom_detail.subject_id' => $subject_id]);

        $pagination = new Pagination([
            'defaultPageSize' => 10,
            'totalCount' => $query->count(),
        ]);

        $exams = $query->offset($pagination->offset)->limit($pagination->limit)
            ->orderBy('id DESC')
            ->all();

        return [
            'exams' => $exams,
            'pages' => $pagination,
        ];
    }

    /**
     * @param $user
     * @return string
     */
    public static function getAvatar($user)
    {
        $avatar = $user['avatar'] ? $user['avatar'] : '/theme/images/default-size-32x32-znd.png';
        if ($user->auth == User::AUTH_FACEBOOK) {
            $avatar = 'https://graph.facebook.com/' . $user['avatar'] . '/picture?type=large';
        }

        return $avatar;
    }

    /**
     * @param $exam_id
     * @return int|string
     */
    public static function count_exam_rounds_by_exam_id($exam_id)
    {
        $count = Room::find()->where(['exam_id' => $exam_id])->count();
        return $count;
    }

    /**
     * @param $user_id
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function get_account_bank_by_user_id($user_id)
    {
        return AccountBank::find()->where(['user_id' => $user_id])->andWhere(['status' => 1])->one();
    }

    /**
     * @param $exam_id
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function get_subject_by_exam_id($exam_id)
    {
        $classroom = Subject::find()
            ->innerJoin('classroom_detail', 'classroom_detail.subject_id = subject.id')
            ->innerJoin('topic', 'topic.classroom_detail_id = classroom_detail.id')
            ->innerJoin('exam', 'exam.topic_id = topic.id')
            ->where(['exam.id' => $exam_id])
            ->andWhere(['subject.status' => Subject::ACTIVE])->one();
        return $classroom;
    }

    /**
     * @param $exam_id
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function get_class_by_exam_id($exam_id)
    {
        $classroom = Classroom::find()
            ->innerJoin('classroom_detail', 'classroom_detail.classroom_id = classroom.id')
            ->innerJoin('topic', 'topic.classroom_detail_id = classroom_detail.id')
            ->innerJoin('exam', 'exam.topic_id = topic.id')
            ->where(['exam.id' => $exam_id])
            ->andWhere(['classroom.status' => Classroom::ACTIVE])->one();
        return $classroom;
    }

    /**
     * @param $exam_id
     * @param $limit
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_users_bought_exam_by_exam_id($exam_id, $limit)
    {
        $query = User::find()->innerJoin('user_exam', 'user.id = user_exam.user_id')->where(['user_exam.exam_id' => $exam_id])->andWhere(['type' => UserExam::BOUGHT]);
        if ($limit) {
            $query->limit($limit);
        }
        return $limit == 1 ? $query->one() : $query->orderBy('user_exam.id DESC')->all();
    }

    /**
     * @param $topic_id
     * @return array|null|\yii\db\ActiveRecord
     */
    public static function get_topic_by_id($topic_id)
    {
        return $topic = Topic::find()->where(['id' => $topic_id])->andWhere(['status' => Topic::DUYET])->andWhere(['active' => Topic::ACTIVE])->andWhere(['display' => 1])->one();
    }

    /**
     * @param string $string
     * @param int $size
     * @param string $link
     * @return bool|string
     */
    public static function cutString($string = '', $size = 50, $link = '[...]')
    {
        $string = strip_tags(trim($string));
        $strlen = strlen($string);
        $str = substr($string, $size, 20);
        $exp = explode(" ", $str);
        $sum = count($exp);
        $yes = "";
        for ($i = 0; $i < $sum; $i++) {
            if ($yes == "") {
                $a = strlen($exp[$i]);
                if ($a == 0) {
                    $yes = "no";
                    $a = 0;
                }
                if (($a >= 1) && ($a <= 12)) {
                    $yes = "no";
                }
                if ($a > 12) {
                    $yes = "no";
                    $a = 12;
                }
            }
        }
        $sub = substr($string, 0, $size + $a);
        if ($strlen - $size > 0) {
            $sub .= $link;
        }
        return $sub;
    }

    public static function count_turn_exam_in_week_by_user_id($user_id)
    {
        $result = [];
        $start_week = date('d/m/Y', strtotime('this week', time()));
        $date_now = date('d/m/Y', time() + 7 * 3600);
        $query = Room::find()->where(['user_id' => $user_id])->asArray()->all();
        foreach ($query as $key => $value) {
            if ($value['created_at'] >= strtotime($start_week) && $value['created_at'] <= strtotime($date_now)) {
                $result[] = $value;
            }
        }
        return $result;
    }

    /**
     * @param $user_id
     * @param $type
     * @return int|mixed
     */
    public static function memberRevenueStatistics($user_id, $type)
    {
        $totalMoney = 0;

        $transactions = TransactionHistory::find()
            ->where(['user_id' => $user_id])
            ->andWhere(['status' => TransactionHistory::SUCCESS])
            ->andWhere(['type' => $type])
            ->all();

        foreach ($transactions as $key => $value) {
            $totalMoney += $value['amount'];
        }

        return $totalMoney;
    }

    /**
     * @param $user
     * @param $type
     * @return int|string
     */
    public static function countBuyOrSellExamUser($user, $type)
    {
        $countExam = TransactionHistory::find()
            ->where(['user_id' => $user])
            ->andWhere(['type' => $type])
            ->count();

        return $countExam;
    }

    /**
     * @param $exam_id
     * @param null $limit
     * @return array
     */
    public static function get_users_tested_of_exam_by_exam_id($exam_id, $limit = null)
    {
        $result = [];
        $count = Room::find()->joinWith('exam')->joinWith('user')->where(['room.exam_id' => $exam_id])->orderBy('scores DESC')->all();
        foreach ($count as $value)
            if (!array_key_exists($value['user_id'], $result) && count($result) < $limit)
                $result[$value['user_id']] = $value;
        return $result;
    }

    /**
     * @param $user_id
     * @return array
     */
    public static function get_exams_by_user_id($user_id)
    {
        $query = Exam::find()->where(['user_id' => $user_id])->andWhere(['status' => Exam::DUYET]);

        $pagination = new Pagination([
            'defaultPageSize' => 6,
            'totalCount' => $query->count(),
        ]);

        $exams = $query->offset($pagination->offset)->limit($pagination->limit)
            ->orderBy('id DESC')
            ->all();

        return [
            'exams' => $exams,
            'pages' => $pagination,
        ];
    }

    /**
     * @param $user_id
     * @return int|string
     */
    public static function count_number_exam_test_of_user_by_user_id($user_id)
    {
        return $query = Room::find()->where(['user_id' => $user_id])->groupBy('exam_id')->count();
    }

    /**
     * @param $limit
     * @return array|null|\yii\db\ActiveRecord|\yii\db\ActiveRecord[]
     */
    public static function get_exam_online($limit)
    {
        $query = Exam::find()->where(['classify' => Exam::SET_TIME_EXAM])->andWhere(['>', 'set_date_time_end', time()]);
        if ($limit) {
            $query->limit($limit);
        }
        return $limit == 1 ? $query->one() : $query->orderBy('set_date_time ASC')->asArray()->all();
    }

    /**
     * @param $exam_id
     * @return int|string
     */
    public static function count_favorite($exam_id)
    {
        $count = UserExam::find()->where(['=', 'exam_id', $exam_id])->andWhere(['type' => UserExam::SAVE])->count();
        return $count;
    }

    /**
     * @param $id
     * @return int|string
     */
    public static function countNumberExam($id)
    {
        $countExam = Room::find()->where(['exam_id' => $id])->count();
        return $countExam;
    }

    /**
     * @param $id
     * @return User|null
     */
    public static function getUser($id)
    {
        $user = User::findOne($id);
        return $user;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function get_class_color($key)
    {
        $colors = ['default', 'one', 'tow', 'three', 'four', 'fine'];

        return isset($colors[$key]) ? $colors[$key] : 'fine';
    }

    /**
     * @param $id
     * @return Question|null
     */
    public static function getQuestion($id)
    {
        $query = Question::findOne($id);

        return $query;
    }

    /**
     * @param $id
     * @return array|bool|\yii\db\ActiveRecord|null
     */
    public static function getParentIdQuestion($id)
    {
        if ($id) {
            $query = Question::find()->where(['parent_id' => $id])->one();

            return $query;
        }

        return false;
    }

    public static function get_question_err_by_parent_question_id($question_id)
    {
        return $question_err = Question::find()
            ->where(['question.parent_id' => $question_id])
            ->one();
    }

    /**
     * @param $exam_id
     * @return string
     */
    public static function get_style_exam_saved($exam_id)
    {
        $user = Yii::$app->user->identity;
        $list_favorite = UserExam::find()->where(['user_id' => $user['id']])->andWhere(['type' => UserExam::SAVE])->all();
        if (count($list_favorite) == 0) {
            return '';
        } else {
            foreach ($list_favorite as $key_favorite => $value_favorite) {
                if ($value_favorite['exam_id'] == $exam_id) {
                    return 'style-red';
                }
            }
        }

        return true;
    }

    public static function get_price_exam($exam_id)
    {
        $exam = Exam::find()->where(['id' => $exam_id])->andWhere(['status' => Exam::DUYET])->one();
        return $exam['price'] ? number_format($exam['price'], '0', ',', '.') . ' đ' : 'Miễn phí';

    }

    /**
     * @param $exam
     * @param $user
     * @return int|string
     */
    public static function getNumberRoomExamBuyUser($exam, $user)
    {
        return $count = Room::find()
            ->where(['exam_id' => $exam])
            ->andWhere(['user_id' => $user])
            ->count();

    }
}
