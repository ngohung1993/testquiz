
$(document).ready(function() {
   $('#check_all').click(function() {
      var checked = $(this).prop('checked');
      $('.odd').find('input:checkbox').prop('checked', checked);
   });
});

function approveAll() {
   var topic_status = $('#topic_status').val();
   var topic_id = $('#topic_id').val();

   if(topic_status == 0){
      alert('Chủ đề này chưa được duyệt');
      return false;
   }

   if(topic_status == 2){
      alert('Chủ đề này không được duyệt');
      return false;
   }

   var checkboxValues = [];

   $('input[type="checkbox"]:checked:not(".not_check")').each(function (index, elem) {
      checkboxValues.push( $(elem).val());
   });
   if (checkboxValues.length === 0) {
      alert('Vui lòng chọn đề thi');
      return false;
   }
   var jsonString = JSON.stringify(checkboxValues);

   $.ajax({
      type: 'POST',
      url: '/admin/ajax/change-status-exam-approve',
      data: {
         data: jsonString,
         topic_id : topic_id,
      },
      success: function (data) {
         if(data){
            alert('Phê duyệt đề thi thành công');
            window.location.reload();
         }
      }
   });
}