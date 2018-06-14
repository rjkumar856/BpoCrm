
<table id="tableone" border="1">
    <thead>
        <tr><th class="col1">Header 1</th></tr>
    </thead>
    <?php
    for($i=0; $i<=4;$i++)
    {
        ?>
    <tr class="del">
        <td contenteditable="false" id="abc<?php echo $i; ?>">Row 0 Column 0</td>//changed to false after experiment
        <td><button class="editbtn" data-filmid="<?php echo $i; ?>">Edit</button></td>
    </tr>
    <?php
   }
   ?>
  </table>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
   $(document).ready(function () {

      $('.editbtn').click(function (e) {
          e.preventDefault();
          
          var $this = $(this);
   
          var currentTD = $(this).parents('tr').find('td');
          if ($(this).html() == 'Edit') {
               
            var value_i = $(this).data('filmid');
            ab = "abc" + value_i;
              $('#abc' + value_i).html('<td id="a" contenteditable="true"><select id="sel"><option value="volvo">Row 0 Column 0</option><option value="saab">Row 0 Column 1</option><option value="mercedes">Row 0 Column 2</option><option value="audi">Row 0 Column 3</option></select></td>');
              $.each(currentTD, function () {
                  $(this).prop('contenteditable', true)
              });
          } else {
                var ab = $("#sel").val();
                alert(ab);
                var value_i = $(this).data('filmid');
                ab = "a" + value_i;
             $.each(currentTD, function () {
                 $('#abc' + value_i).html('<td  contenteditable="false" id="abc">Row 0 Column 0</td>');
                  $(this).prop('contenteditable', false)
              });
          }

          $(this).html($(this).html() == 'Edit' ? 'Save' : 'Edit')

      });
       

  });
</script>