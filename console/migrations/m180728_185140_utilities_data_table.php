<?php

use yii\db\Migration;
use common\models\Exam;
use common\models\User;

/**
 * Class m180728_185140_utilities_data_table
 */
class m180728_185140_utilities_data_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->batchInsert('{{%utilities}}', [
            'id',
            'serial',
            'permission',
            'title',
            'icon',
            'path',
            'parent_id',
            'released',
            'status'
        ], [
            [1, 1, User::ROLE_ADMIN, 'Trang chủ', 'fa fa-home', 'site/index', null, 1, 1],

            [2, 2, User::ROLE_ADMIN, 'Cài đặt nâng cao', 'fa fa-cogs', null, null, 1, 1],

            [3, 1, User::ROLE_ADMIN, 'Trang', 'fa fa-clone', 'page/index', 2, 1, 1],
            [4, 2, User::ROLE_ADMIN, 'Vị trí ảnh', 'fa fa-picture-o', 'photo-location/index', 2, 1, 1],
            [5, 3, User::ROLE_ADMIN, 'Cấu hình', 'fa fa-cog', 'setting/index', 2, 1, 1],
            [6, 4, User::ROLE_ADMIN, 'Tiện ích', 'fa fa-arrows-alt', 'utilities/index', 2, 1, 1],

            [7, 3, User::ROLE_ADMIN, 'Cài đặt hệ thống', 'fa fa-sliders', 'general-information/index', null, 1, 1],

            [8, 4, User::ROLE_ADMIN, 'Quản lý nội dung', 'fa fa-edit', null, null, 1, 1],

            [9, 1, User::ROLE_ADMIN, 'Danh mục', 'fa fa-tags', 'category/index', 8, 1, 1],
            [10, 2, User::ROLE_ADMIN, 'Bài viết', 'fa fa-edit', 'post/index', 8, 1, 1],

            [11, 5, User::ROLE_ADMIN, 'Lớp', 'fa fa-university', 'classroom/index', null, 1, 1],
            [12, 6, User::ROLE_ADMIN, 'Môn học', 'fa fa-briefcase', 'subject/index', null, 1, 1],
            [13, 7, User::ROLE_ADMIN, 'Chủ đề', 'fa fa-cubes', 'topic/index', null, 1, 1],

            [14, 8, User::ROLE_ADMIN, 'Đề thi', 'fa fa-graduation-cap', null, null, 1, 1],

            [15, 1, User::ROLE_ADMIN, 'Đề thi tải lên', 'fa fa-circle-o', 'exam/index?status=' . Exam::CHO_DUYET, 14, 1, 1],
            [16, 2, User::ROLE_ADMIN, 'Đề thi đã duyệt', 'fa fa-circle-o', 'exam/index?status=' . Exam::DUYET, 14, 1, 1],
            [17, 3, User::ROLE_ADMIN, 'Đề thi vi phạm', 'fa fa-circle-o', 'exam/index?status=' . Exam::KHONG_DUYET, 14, 1, 1],

            [18, 9, User::ROLE_ADMIN, 'Tài khoản', 'fa fa-users', null, null, 1, 1],

            [19, 1, User::ROLE_ADMIN, 'Nhân viên', 'fa fa-circle-o', 'user/staff', 18, 1, 1],
            [20, 2, User::ROLE_ADMIN, 'Người dùng', 'fa fa-circle-o', 'user/client', 18, 1, 1],

            [21, 10, User::ROLE_ADMIN, 'Thanh toán', 'fa fa-money', 'payment/index', null, 1, 1]
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m180728_185140_utilities_data_table cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m180728_185140_utilities_data_table cannot be reverted.\n";

        return false;
    }
    */
}
