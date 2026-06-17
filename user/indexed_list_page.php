
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







if (isset($_GET['newindex']) && $_GET['newindex'] == 1) {

    // Formdan gelen verileri al
    $name = $_POST['name'];
    $link = $_POST['link'];
    $goster = $_POST['goster'];
    $sira = $_POST['sira'];
    $aciklama = $_POST['aciklama'];

    // Resim dosyasını işleme
    $target_dir = "../images/";
    $filename = basename($_FILES["image"]["name"]);
    $target_file = $target_dir . $filename;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $uploadOk = 1;

    // Check if the file is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Dosya türü kontrolü (JPEG, PNG, GIF, JPG)
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Dosya boyutu kontrolü (örneğin 2MB sınırı)
    if ($_FILES["image"]["size"] > 2000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Eğer dosya geçerli ise yükle
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $image = basename($_FILES["image"]["name"]); // Dosya adını al ve veritabanına kaydet
        } else {
            echo "Sorry, there was an error uploading your file.";
            exit();
        }
    } else {
        echo "Sorry, your file was not uploaded.";
        exit();
    }

    // SQL sorgusu (Prepared Statement for SQL Injection prevention)
    $stmt = $baglanti->prepare("INSERT INTO `indexed_list` (`name`, `link`, `image`, `goster`, `sira`, `aciklama`) 
                                VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssiss", $name, $link, $filename, $goster, $sira, $aciklama);

    // Veritabanına kaydet
    if ($stmt->execute()) {
        echo "Record successfully inserted.";
    } else {
        echo "Database Error: " . $stmt->error;
    }

    $stmt->close();
}






if (isset($_GET['newindex']) && $_GET['newindex'] == 2) {

    // Formdan gelen verileri al
    $indexid = $_POST['indexid'];
    $name = $_POST['name'];
    $link = $_POST['link'];
    $goster = $_POST['goster'];
    $sira = $_POST['sira'];
    $aciklama = $_POST['aciklama'];

    // Check if file upload is set and no error occurred
    if (isset($_FILES["image2"]) && $_FILES["image2"]["error"] == 0) {

        // Resim dosyasını işleme
        $target_dir = "../images/";
        $filename = basename($_FILES["image2"]["name"]);
        $target_file = $target_dir . $filename;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $uploadOk = 1;

        // Check if the file is an actual image
        $check = getimagesize($_FILES["image2"]["tmp_name"]);
        if ($check === false) {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Dosya türü kontrolü (JPEG, PNG, GIF, JPG)
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
            $uploadOk = 0;
        }

        // Dosya boyutu kontrolü (örneğin 2MB sınırı)
        if ($_FILES["image2"]["size"] > 2000000) {
            echo "Sorry, your file is too large.";
            $uploadOk = 0;
        }

        // If all checks pass, try to upload the file
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image2"]["tmp_name"], $target_file)) {
                $image = basename($_FILES["image2"]["name"]); // Dosya adını al ve veritabanına kaydet
            } else {
                echo "Sorry, there was an error uploading your file.";
                exit();
            }
        } else {
            echo "Sorry, your file was not uploaded.";
            exit();
        }

        // SQL sorgusu (Prepared Statement for SQL Injection prevention)
        $stmt = $baglanti->prepare("UPDATE `indexed_list` 
                    SET `name` = ?, 
                        `link` = ?, 
                        `image` = ?, 
                        `goster` = ?, 
                        `sira` = ?, 
                        `aciklama` = ?
                    WHERE `id` = ?");
        $stmt->bind_param("sssisis", $name, $link, $filename, $goster, $sira, $aciklama, $indexid);

    } else {

        // SQL sorgusu without image update
        $stmt = $baglanti->prepare("UPDATE `indexed_list` 
                    SET `name` = ?, 
                        `link` = ?, 
                        `goster` = ?, 
                        `sira` = ?, 
                        `aciklama` = ?
                    WHERE `id` = ?");
        $stmt->bind_param("ssisis", $name, $link, $goster, $sira, $aciklama, $indexid);
    }

    // Veritabanına kaydet
    if ($stmt->execute()) {
        echo "Record updated successfully.";
    } else {
        echo "Database Error: " . $stmt->error;
    }

    $stmt->close();
}






if(isset($_GET['indexid'])){
        // GET metodu ile gelen veriler
        $indexid = $_GET['indexid'];
        $durum = $_GET['durum'];
        
        // `indexid` ile eşleşen kaydın `goster` sütununu güncelle
       
        $sql = "UPDATE indexed_list SET goster = $durum  WHERE id = $indexid";
        
        if ($query = mysqli_query($baglanti, $sql)) {
           // echo "Kayıt başarıyla güncellendi.";
        } else {
            echo "Database Error .... ";
        }

}

?>

<a  aria-label="hide/show"   href="#" onclick="document.getElementById('id01').style.display='block'"
                                       class="btn btn-success btn-authors"><i class="fa fa-plus"></i>Add  New Index
  
                                    </a>
<?php

echo '<table id="datatable" class="table table-striped table-bordered">
            <thead>
            <tr>
               <th width="5%">#</th>
               <th width="15%">Name</th>
               <th width="35%">Link</th>
               <th width="15%">image</th>
               <th  width="5%">State</th>
               <th width="15%">Process</th>
            </tr>
            </thead>
            <tbody>';

if ($query = mysqli_query($baglanti, "select * from indexed_list ")) {
    $sira = 1;
    while ($data = mysqli_fetch_array($query)) {
        echo "<tr>";
        echo "<td>" . $sira . "</td>";
        $sira += 1;
        echo "<td>" . $data["name"] . "</td>";
        echo '<td> <a class="btn "  href="'.$data["link"].'">' . $data["name"] . '</td>';
        echo '<td>   <img src=../images/' . $data["image"] . ' height="40px"></td>';
        
        if($data['goster']) 
        
            echo '<td> <a href="" class="btn btn-primary" aria-label="View ">
 <i class="fa fa-eye fa-2x" aria-hidden="true"></i>
</a>  </td>' ;
        else
            echo '<td>  <a class="btn btn-danger" href="" aria-label="Hide / Show">
  <i class="danger fa fa-eye-slash fa-2x" aria-hidden="true"></i>
</a>  </td>';  
       // echo '<td> <i class="fa fa-eye fa-6" aria-hidden="true"></i>  <i class="fa fa-eye-slash fa-5" aria-hidden="true"></i>  </td>';
        
        
       
         echo '<td > ';
         
         if($data['goster'])  
             echo '  <a class="btn btn-round btn-danger inbox-title"   href="https://'.$journalDomain.'/user/index.php?page=indexedlistpage&m_id=29&rnb=1&indexid='.$data["id"].'&durum=0">  Hide </a>';
         else
           echo '
            <a class="btn btn-round btn-success inbox-title" style="color:black" href="https://'.$journalDomain.'/user/index.php?page=indexedlistpage&m_id=29&rnb=1&indexid='.$data['id'].'&durum=1">  Show </a>';
          
 
                  ?>                  
                                    
                                    
             <a aria-label="hide/show" href="#" 
   onclick="populateModal('<?php echo $data['id']; ?>', '<?php echo $data['name']; ?>', '<?php echo $data['link']; ?>', '<?php echo $data['sira']; ?>', '<?php echo $data['aciklama']; ?>')" 
   class="btn btn-success btn-authors">
   <i class="fa fa-edit"></i>Edit
</a>

            
            
          
                                       
        <?php
                                    
                                    echo '</td>';
    
        
        
        
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
                     
                    
                    
                    <form action="../user/index.php?page=indexedlistpage&m_id=29&rnb=1&newindex=1" method="post" enctype="multipart/form-data">
                            <label for="name">Index Name:</label>
                            <input type="text" id="name" name="name" required><br>
                        
                            <label for="link">Link:</label>
                            <input type="text" id="link" name="link" required><br>
                        
                            <label for="image">Image:</label>
                            <input type="file" id="image" name="image" required><br>
                        
                            
                            <input type="hidden" id="goster" name="goster" value=0><br>
                        
                            <label for="sira">Sira:</label>
                            <input type="number" id="sira" name="sira" required><br>
                        
                            <label for="aciklama">Description:</label><br>
                            <textarea id="aciklama" name="aciklama" rows="4" cols="150"></textarea><br>
                        
                            <input class="btn-round btn-success" type="submit" value="Submit">
                        </form>
                                            
                    
                </div>

            </div>
        </div>


<!--  updete-->



       <div id="id02" class="modal">

            <div class="modal-content animate">
                <div class="imgcontainer">
                <span onclick="document.getElementById('id02').style.display='none'" class="close"
                      title="Close Modal">&times;</span>
                </div>

                <div class="container1">
                     
                    
                    
                    <form action="../user/index.php?page=indexedlistpage&m_id=29&rnb=1&newindex=2" method="post" enctype="multipart/form-data">
                            <label for="name">Index Name:</label>
                            <input type="text" id="name2" name="name" required><br>
                        
                            <label for="link">Link:</label>
                            <input type="text" id="link2" name="link" required><br>
                            
                            <label for="link">Link:</label>
                            <input type="hidden" id="indexid" name="indexid" required><br>
                            
                            <label for="image">Image:</label>
                            <input type="file" id="image2" name="image2" ><br>
                        
                            
                            <input type="hidden" id="goster2" name="goster" value=0><br>
                        
                            <label for="sira">Sira:</label>
                            <input type="number" id="sira2" name="sira" required><br>
                        
                            <label for="aciklama">Description:</label><br>
                            <textarea id="aciklama2" name="aciklama" rows="4" cols="150"></textarea><br>
                        
                            <input class="btn-round btn-success" type="submit" value="Submit">
                        </form>
                                            
                    
                </div>

            </div>
        </div>





<script type="text/javascript">
  function populateModal(id, name, link,  sira, aciklama) {
    document.getElementById('id02').style.display='block';  // Show the modal
    
    // Fill the form fields with data from the selected row
    document.getElementById('name2').value = name;
    document.getElementById('link2').value = link;
    document.getElementById('indexid').value = id;
    // Assuming image is displayed somewhere or needs to be updated, though uploading a new image would be required.
   
    document.getElementById('sira2').value = sira;
    document.getElementById('aciklama2').value = aciklama;

    // Set the form action dynamically to include the correct ID for update
    document.querySelector('#id02 form').action = '../user/index.php?page=indexedlistpage&m_id=29&rnb=1&indexid=' + id + '&newindex=2';
  }
</script>
