
<style>
    /* Full-width input fields */
    .modal input[type=text] {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }

    .modal input  {
        width: 100%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    
    
    .modal select  {
        width: 50%;
        padding: 12px 20px;
        margin: 8px 0;
        display: inline-block;
        border: 1px solid #ccc;
        box-sizing: border-box;
    }
    .container1 {
        padding: 20px;
    }

    /* The Modal (background) */
    .modal {
        display: none; /* Hidden by default */
        position: fixed; /* Stay in place */
        z-index: 99999; /* Sit on top */
        left: 0;
        top: 0;
        /*width: 100%; /* Full width */
        /*height: 100%; /* Full height */
        /* overflow: auto; /* Enable scroll if needed */
        background-color: rgb(0, 0, 0); /* Fallback color */
        background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        padding-top: 60px;
    }

    /* Modal Content/Box */
    .modal-content {
        background-color: #fefefe;
        margin: auto ; /* 5% from the top, 15% from the bottom and centered */
        border: 1px solid #888;
        width: 50%; /* Could be more or less, depending on screen size */
       
    }

    /* The Close Button (x) */
    .close {
        position: absolute;
        right: 25px;
        top: 0;
        color: #000;
        font-size: 35px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: red;
        cursor: pointer;
    }

    .author_name {
        width: 100%;
        padding: 0px 0px;
        margin: 0;
        display: inline-block;
        border: 0px solid #ccc;
        box-sizing: border-box;
    }

 
	
	.loading {
	
	 background:#ffff;
  position:absolute;
  color:#fff;
  top:50%;
  left:50%;
  padding:15px;
  -ms-transform: translateX(-50%) translateY(-50%);
  -webkit-transform: translate(-50%,-50%);
  transform: translate(-50%,-50%);
}
</style>

<?php
include("../app/connect.php");
$user_name=$_SESSION["user"];










if ($_GET['newuser'] == 1) {
    // Formdan gelen verileri al
    $name_lastname = $_POST['name_lastname'];
    $affiliation = $_POST['affiliation'];
    $country = $_POST['country'];
    $mail = $_POST['mail'];
    $role = $_POST['role'];
    $date = $_POST['date'];

    // Veritabanına kaydet
    $sql = "INSERT INTO `Editor_list`( `name_lastname`, `affilation`, `country`, `mail`, `role`, `goster`, `date`)  VALUES ('".$name_lastname."','". $affiliation."','". $country."','". $mail."','". $role."',0 ,'". $date."')";
           
   
   if ($query = mysqli_query($baglanti, $sql)) {
           // echo "Kayıt başarıyla güncellendi.";
        } else {
            echo "Database Error .... ";
        }

}







if(isset($_GET['indexid'])){
        // GET metodu ile gelen veriler
        $indexid = $_GET['indexid'];
        $durum = $_GET['durum'];
        
        // `indexid` ile eşleşen kaydın `goster` sütununu güncelle
       
        $sql = "UPDATE Editor_list SET goster = $durum  WHERE id = $indexid";
        
        if ($query = mysqli_query($baglanti, $sql)) {
           // echo "Kayıt başarıyla güncellendi.";
        } else {
            echo "Database Error .... ";
        }

}

?>

<a  aria-label="hide/show"   href="#" onclick="document.getElementById('id01').style.display='block'"
                                       class="btn btn-success btn-authors"><i class="fa fa-plus"></i>Add  New Editor
  
                                    </a>
<?php
echo '<table id="datatable" class="table table-striped table-bordered">
            <thead>
            <tr>
               <th width="5%">#</th>
               <th width="15%">Name Last Name / e-mail</th>
               <th width="25%">Affilation</th>
               <th width="10%">Country</th>
               <th width="10%">Role</th>
               <th  width="5%">State</th>
               <th width="15%">Process</th>
            </tr>
            </thead>
            <tbody>';

 

if ($query = mysqli_query($baglanti, "select * from Editor_list order by role, name_lastname")) {
    $sira = 1;
    while ($data = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $sira . "</td>";
        $sira += 1;
        echo "<td>" . $data["name_lastname"] ." <br>".$data["mail"]. "</td>";
        echo "<td>" . $data["affilation"] . "</td>";
        echo '<td> ' . $data["country"] . '</td>';
        echo '<td> ' . $data["role"] . '</td>';
        
        if($data['goster']) 
        
            echo '<td> <a href="" class="btn btn-primary" aria-label="hide/show">
 <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
</a>  </td>' ;
        else
            echo '<td>  <a class="btn btn-danger" href="" aria-label="hide/show">
  <i class="danger fa fa-eye-slash fa-2x" aria-hidden="true"></i>
</a>  </td>';  
       // echo '<td> <i class="fa fa-eye fa-6" aria-hidden="true"></i>  <i class="fa fa-eye-slash fa-5" aria-hidden="true"></i>  </td>';
        
        
       
        
         if($data['goster']) 
             echo '<td > 
             <a class="btn btn-round btn-danger inbox-title"   href="https://'.$journalDomain.'/user/index.php?page=editorlistpage&m_id=29&rnb=1&indexid='.$data["id"].'&durum=0">  Hide </a>
            </td>';
        else
           echo '<td >
            <a class="btn btn-round btn-success inbox-title" style="color:black" href="https://'.$journalDomain.'/user/index.php?page=editorlistpage&m_id=29&rnb=1&indexid='.$data['id'].'&durum=1">  Show </a>
            
      </td>'; 
    
        
        
        
        echo "</tr>";
        
       

    }
}
echo "</tbody>
        </table>";

?>


 <div id="id01" class="modal">

            <div class="modal-content animate">
                <div class="imgcontainer">
                <span onclick="document.getElementById('id01').style.display='none'" class="close"
                      title="Close Modal">&times;</span>
                </div>

                <div class="container1">
                   
                    
                    
       <form method="post" action="../user/index.php?page=editorlistpage&m_id=29&rnb=1&newuser=1">
            <label for="name_lastname"><b>Name Lastname:</b></label><br>
            <input type="text" id="name_lastname" name="name_lastname" required><br><br>
    
            <label for="affiliation"><b>Affiliation:</b></label><br>
            <input type="text" id="affiliation" name="affiliation" required><br><br>
    
            <label for="country"><b>Country:</b></label><br>
            <input type="text" id="country" name="country" required><br><br>
    
            <label for="mail"><b>mail:</b></label><br>
            <input type="email" id="mail" name="mail" required><br><br>
    
            <label for="role"><b>Role:</b></label><br>
            <select id="role" name="role" required>
                <option value="editor">Editor</option>
                <option value="editor_in_chief">Editor in Chief</option>
                <option value="subject_editor">Subject Editor</option>
                <option value="managing_editor">Managing Editor</option>
            </select><br><br>
    
             <label for="role"><b>Date:</b></label>  <?php echo date("Y-m-d"); ?>
            <input type="hidden" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" ><br><br>
    
            <input  class="btn btn-round btn-success" type="submit" value="Kaydet">
    </form>
    
    
                </div>

            </div>
        </div>

