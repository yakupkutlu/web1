<?php
include("../app/connect.php");

if (yetki_kontrol($role_number, "edit_menu")) {
    ?>
    <!-- YOUR CONTENT WILL START HERE -->


    <script type="text/javascript">
        // BeginOAWidget_Instance_2204022: #postContent

        tinyMCE.init({
            // General options
            width: "100%",
            mode: "exact",
            elements: "postContent",
            theme: "advanced",
            skin: "default",
            force_br_newlines: true,
            force_p_newlines: false,
            forced_root_block: '',
            plugins: "pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave",

            // Theme options
            theme_advanced_buttons1: "bold,italic,underline,strikethrough,justifyleft,justifycenter,justifyright,justifyfull,fontsizeselect,forecolor,|,code",
            theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,|,image,|,insertdate,inserttime,",
            theme_advanced_buttons3: "hr,cite,abbr,acronym,del,ins,sub,sup,visualchars,nonbreaking,charmap,ltr,rtl,|,preview,fullscreen,help,cleanup,removeformat,|,styleprops,attribs,",
            theme_advanced_buttons4: "tablecontrols,visualaid,|,insertlayer,moveforward,movebackward,absolute,visualaid,|,template,pagebreak,restoredraft,",
            theme_advanced_toolbar_location: "top",
            theme_advanced_toolbar_align: "left",
            theme_advanced_statusbar_location: "bottom",
            theme_advanced_resizing: false,

            // Example content CSS (should be your site CSS)
            //content_css : "/css/editor_styles.css",

            // Drop lists for link/image/media/template dialogs, You shouldn't need to touch this
            template_external_list_url: "/lists/template_list.js",
            external_link_list_url: "/lists/link_list.js",
            external_image_list_url: "/lists/image_list.js",
            media_external_list_url: "/lists/media_list.js",

            // Style formats: You must add here all the inline styles and css classes exposed to the end user in the styles menus
            style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
            ]
        });

        // EndOAWidget_Instance_2204022
    </script>
    <!-- Textarea gets replaced with TinyMCE, remember HTML in a textarea should be encoded -->
    <?php

    $edit_page = $_GET["edit_page"];
    if ($edit_page == "content") {
        echo "<center><a class='btn btn-round btn-warning inbox-title'>Edit CONTENT</a></center>
        <table id=\"datatable\" class=\"table table-striped table-bordered\">
            <thead>
            <tr>
               <th>ID</th>
                <th colspan='2'>Manuscript Paper</th>
                <th style='text-align: center'>Process</th>
            </tr>
            </thead>
            <tbody>";
        $content_page_sql = mysqli_query($baglanti,"SELECT `year`,`volume`,`no`,id FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1 GROUP BY `year`,`volume`,`no` ORDER BY `year` DESC, `volume` DESC, `no` DESC LIMIT 1");
        $content_page = mysqli_fetch_array($content_page_sql);
        $volume = $content_page["volume"];
        $no = $content_page["no"];
        $content_id=$content_page["id"];
        $year = $content_page["year"];
        $sql_str = "SELECT * FROM `submission_list` WHERE `accept` = 1 AND `publish` = 1 AND `year` = $year AND `volume` = $volume AND `no` = $no ORDER BY start_page";
        $query = mysqli_query($baglanti,$sql_str);
        $sira = 1;
        while ($tmp = mysqli_fetch_array($query)) {
            echo "<tr>";
            echo "<td>" . $sira . "</td>";
            $sira += 1;
            //echo "<td>" . yayin_bilgilerini_yaz($tmp). "</td>";
            echo "<td><a href='javascript:void(0)' onclick='popupwindow(\"show_content_page.php?id=" . $content_id . "\",600,700);'><strong>" . $tmp["title"] . "</strong></br>" . $tmp["authors"] . "</a></td>";
            echo "<td>" . $tmp["pp"] . "</td>";
            echo "<td align='center'>
            <a href='index.php?page=upload_file&process=pdf&m_id=1&id=". $tmp["id"] . "'><img src='../images/icon/up_pdf.png' height='28px' style='padding-right:10px;' title='Upload PDF File'></a> 
            <a href='index.php?page=upload_file&m_id=1&id=". $tmp["id"] . "'><img src='../images/icon/up_word.png' height='28px'  style='padding-right:10px;' title='Upload WORD File'></a>            
            <a href='download_pdf.php?file=" . $tmp["paperfile1"] . "' target='_blank'><img src='../images/icon/down_pdf.jpg' title='Download PDF File' style='padding-right:10px;' height='28px' ></a>
            <a href='" . $tmp["word_format"] . "' target='_blank'><img src='../images/icon/down_word.ico' title='Download WORD File' style='padding-right:10px;' height='28px' ></a>
            <a href='index.php?page=edit_page&m_id=1&edit_page=content_edit&p_id=" . $tmp["id"] . "'><img src='../images/icon/edit.ico' title='Edit Paper' style='padding-right:10px;' height='28px' ></a>edit_edit_editedit_edit_edit_edit_edit_edit_edit_edit__
            
            </td>";
            echo "</tr>";
            //<a href='javascript:void(0)' onclick='popupwindow(\"upload_file.php?process=pdf&id=" . $tmp["id"] . "\",350,150);'><i title='Add  PDF File' class=\"fa fa-file-pdf-o\" style='padding-right:10px;'></i></a>
            //<a href='javascript:void(0)' onclick='popupwindow(\"upload_file.php?id=" . $tmp["id"] . "\",350,150);'><i title='Add WORD File' class=\"fa fa-upload\" style='padding-right:10px;'></i></a>

        }
        echo "</tbody>
        </table>";


    }
    //END content sayfası
    if ($edit_page == "content_edit") {
        $p_id = $_GET["p_id"];
        $pQuery = "Select * from submission_list where id=$p_id";
        $paperProp = mysqli_fetch_object(mysqli_query($baglanti,$pQuery));
        $paperTitle = $paperProp->title;
        $authors = $paperProp->authors;
        $abstract = $paperProp->abstract;
        $references = $paperProp->references;
        $keywords = $paperProp->keyword;
        $volume = $paperProp->volume;
        $no = $paperProp->no;
        $pp = $paperProp->pp;
        $start_page = $paperProp->start_page;
        $year = $paperProp->year;
        $yturu = $paperProp->yayin_turu;
        $doi= $paperProp->doi;
        ?>
        <form class="form-horizontal form-label-left" method="post"
              action="publish_paper_page.php?process=content_save&id=<?php echo $p_id; ?>">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Title<span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="title" required="required" class="form-control col-md-7 col-xs-12"
                                   value="<?php echo $paperTitle; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Authors<span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="authors" required="required" class="form-control col-md-7 col-xs-12"
                                   value="<?php echo $authors; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Abstract<span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea class="form-control" name="abstract" rows="12"><?php echo $abstract; ?></textarea>
                        </div>
                    </div>
                    
                    
                    
                     <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Keywords<span
                                    class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="keywords1" required="required" class="form-control col-md-7 col-xs-12"
                           value="<?php echo $keywords; ?>">
                </div>
            </div>
            
            
            
            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">References<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <textarea class="form-control" name="references" rows="12"><?php echo $references; ?></textarea>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Volume<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="volume" required="required" class="form-control col-md-7 col-xs-12"
                           value="<?php echo $volume; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Number<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="number" required="required" class="form-control col-md-7 col-xs-12"
                           value="<?php echo $no; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">PP<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="pp" required="required" class="form-control col-md-7 col-xs-12"
                           value="<?php echo $pp; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">First Pge Number<span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="start_page" required="required" class="form-control col-md-7 col-xs-12" value="<?php echo $start_page; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Year<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="year" required="required" class="form-control col-md-7 col-xs-12"
                           value="<?php echo $year; ?>">
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Yayın Türü<span
                            class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="yturu" required="required" placeholder="1 (for article),  2 (for symposium Article), 3 (for abstract), 4 (for Book)" class="form-control col-md-7 col-xs-12"
                           value="<?php echo $yturu; ?>">
                </div>

            </div>
            
            
 				<div class="form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">DOI<span
                            class="">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" name="doi"  class="form-control col-md-7 col-xs-12"
                           value="<?php echo $doi; ?>">
                </div>
            </div>            
            
            

            <div class="form-group">

                <div style="text-align: center">
                    <br>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
        <?php

    }////END content_edit sayfası



$edit_mail = $_GET["edit_mail"];



 if ($page == "edit_page" && $edit_mail == "edit_page") {
 	
 	
 	       $query = mysqli_query($baglanti,"SELECT * FROM mailTable WHERE id= '$edit_page'");
        while ($data = mysqli_fetch_array($query)) {
            $content = $data["text"];
            $menu = $data["aciklama"];
            $mailsubject=$data["subject"]; /// eklenecek kayıt için    
        }

        ?>

        <div>
            <form action="update_static_content.php?rnb=1&edit_mail=edit_page" method="post">
                <table width="100%">
                    <tr>
                        <td><br>
                            <center><span style="color:red;"><?php echo strtoupper($menu); ?></span>&nbsp; &nbsp;İÇERİĞİNİ
                                DÜZENLE
                            </center>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"><br>
                            <textarea id="postContent" name="postContent" rows="25" cols="90">
                                    <?php echo $content; ?>
                                </textarea>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"><br>
                            <input type="submit" value="Update Content" id="btn">
                        </td>
                    </tr>
                      <tr>
                        <td align="center"><br>
                                   Hint : for som constant values such as journal name, domain, etc.  write in text  as 
	[[journalName]],[[journalShortName]], [[journalEditorChef]], [[journalISSN]], [[journalDomain]], [[journalMail]]
	, [[jEditorChefMail]],  [[paperIDstart]].
	
                        </td>
                    </tr>
                </table>
                <input type="hidden" name="page" value="<?php echo $edit_page; ?>">
            </form>

        </div>
    <?php }



if ($edit_page != "content" && $edit_page != "content_edit" && $edit_mail != "edit_page" ) {
        $query = mysqli_query($baglanti,"SELECT * FROM static_content WHERE page_name= '$edit_page' AND state= 1");
        while ($data = mysqli_fetch_array($query)) {
            $content = $data["content"];
            $menu = $data["menu_name"];
        }

        ?>

        <div>
            <form action="update_static_content.php?rnb=1" method="post">
                <table width="100%">
                    <tr>
                        <td><br>
                            <center><span style="color:red;"><?php echo strtoupper($menu); ?></span>&nbsp; &nbsp;İÇERİĞİNİ
                                DÜZENLE
                            </center>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"><br>
                            <textarea id="postContent" name="postContent" rows="25" cols="90">
                                    <?php echo $content; ?>
                                </textarea>
                        </td>
                    </tr>

                    <tr>
                        <td align="center"><br>
                            <input type="submit" value="Update Content" id="btn">
                        </td>
                    </tr>
                   
                </table>
                <input type="hidden" name="page" value="<?php echo $edit_page; ?>">
            </form>



        </div>

    <?php }
    echo "<script>
    function popupwindow(url, w, h) {
        var left = (screen.width / 2) - (w / 2);
        var top = (screen.height / 2) - (h / 2);
        return window.open(url, null, 'toolbar=no, location=no,resizable=0, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);
    }
</script>";
} else header("Refresh:0;  URL = 404.php ");
