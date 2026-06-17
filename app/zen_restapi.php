<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


 
require 'vendor/autoloader.php'; // GuzzleHTTP kütüphanesini yükleyin

use GuzzleHttp\Client;

use GuzzleHttp\Exception\RequestException;

$client = new Client();    // HTTP client nesnesini oluştur



//process=create  or update or fileupload
if(isset($_GET["paperID"]))
{
		$id = $_GET["paperID"];
		$access_token='EqRSKrRuwPNhHSjhErhAsDFeV9iPIWVETrYnZuckKLdN1qDu2THCvQvXLZEd';
		
		include("connect.php");
		
		$query = "SELECT * FROM makale";
		$result = mysqli_query($baglanti,"SELECT * FROM submission_list WHERE id=$id AND `accept` = 1 ");  // kabul edilen ama basılmayan


		if (!$result) {
			MesajGoster("Db Error !!!");
			die("Database Error: " . mysqli_error($baglanti));
			 
		}


		$makale = mysqli_fetch_assoc($result);

					$title = $makale["title"];
					$authors = $makale["authors"];
					$id = $makale["id"];
					$abstract = $makale["abstract"];
					$keywords = $makale["keyword"];
					$volume = $makale["volume"];
					$no = $makale["no"];
					$pp = $makale["pp"];
					$year = $makale["year"];
					$yayin_turu = $makale["yayin_turu"];
					$referans = $makale["references"]; 
					$publish_date = $makale["publish_date"];
					$downloadlink = $makale["paperfile1"];
					$view	=	$makale["view"];
					$download	=	$makale["download"];
					$doi = $makale["doi"];
					$zenodoID =	$makale["zenodoID"];
					


/*
        $referans = str_replace("'","",$referans );
		 $referans = str_replace('"',"",$referans );	
		$referans1 = explode('<br>', $referans); // array oldu	
		 
		$referanslar="";
		for ($i=1;$i<count($referans1);$i++)
			 $referanslar.='"'.trim($referans1[$i]).'", ';
			 
		 $referanslar = "[".substr($referanslar, 0, -6). "]";
		 
 		*/
 		
 		
             
            // Tek ve çift tırnakları kaldır
            $referans = str_replace("'", "", $referans);
            $referans = str_replace('"', "", $referans);
            
            // Referansları array'e dönüştür
            $referans1 = explode('<br>', $referans);
            
            // Referansları uygun formata çevir
            $referanslar = "[";
            
            foreach ($referans1 as $ref) {
                $ref = trim($ref);
                if (!empty($ref)) {  // Boş olan satırları atla
                    $referanslar .= '"' . $ref . '",';
                }
            }
            
            // Son karakter olan fazladan virgülü kaldır ve diziyi kapat
            $referanslar = rtrim($referanslar, ',') . "]";
            
            // Sonucu yazdır veya kullan
       //     echo $referanslar;
         //    die();
            
             		
			
		$authors = explode(',',$makale["authors"]);
		$str = explode(",",$makale["authors"]);
		 for ($i=0;$i<count($str);$i++)
			 $yazarlar[$i]['name']=trim($str[$i]);

		 
		 // JSON verisi
		$data = array(
			'metadata' => array(
				'title' => $makale['title'],
				'upload_type' => 'publication',
				'publication_type' => 'article',
				'publication_date' => $publish_date,
				'description' => $makale['abstract'],
				'access_right' => 'open',
				'keywords' => explode(', ', $makale["keyword"]), // Keywords alanını dizi olarak ayırıyoruz
				'journal_title' => $journalName,
				'journal_volume' => $makale['volume'],
				'journal_issue' => $makale['no'],
				'journal_pages' => $makale['pp'],
				'journal_issn' =>  $journalISSN,
				'imprint_publisher' =>  $journalName,
				'notes' =>  'ISSN : ' . $journalISSN,
				'language' =>  'eng',
				'issn' =>  $journalISSN,	
				'references' =>$referans1,
				'creators' =>  $yazarlar // Yazarlar alanını da dizi içinde bir dizi olarak ekliyoruz
			
			)
		);
		 
		 
		 	 
	 
		 // 	'dates' =>  '[{"start": "2018-03-21", "end": "2018-03-21", "type": "Collected", "description": "available"}]',
			

	
   

	 
		   	
		   	
		  
		   	
		   	
 

		try {
			
			
					
				if($zenodoID=="" && $_GET["process"]=="create")
				{
					 	$url = 'https://zenodo.org/api/deposit/depositions?access_token='.$access_token;
					  $response = $client->post($url, [
                        'headers' => [
                            'Content-Type' => 'application/json',
                        ],
                        'json' => $data,
                    ]);
                    $processResultMessage="new DOI is created : ";
                  
				
				  // Eğer istek başarılı olursa yanıtı işleme
                    $data = $response->getBody();
                    $json = json_decode($data, true);
                    $processResultMessage= $processResultMessage . $json['metadata']['prereserve_doi']['doi'];
					 
				}
				elseif($zenodoID!="" && $_GET["process"]=="update")
				{
					
				 
						
					$url = 'https://zenodo.org/api/deposit/depositions/'.$zenodoID.'?access_token='.$access_token;	
					$response = $client->put($url, [
						'headers' => [
							'Content-Type' => 'application/json',
						],
						'json' => $data,
					]);
					  
					   
					$processResultMessage="  The informations was updated : ";
				 
			 	
				
				
				} 
				elseif($_GET["process"]=="fileupload")
				{
				
				/*
				
					$url = 'https://zenodo.org/api/deposit/depositions/'.$zenodoID. '/files';
				 			
								// Dosya bilgileri
					$fileName = $journalShortName . '_0611503.pdf';
					$filePath = '../uploadfiles/' . $journalShortName . '_0611503.pdf';
					
					
					
			

                    //curl -i https://zenodo.org/api/deposit/depositions/1234/files/12345678-9abc-def1-2345-6789abcdef12?access_token=ACCESS_TOKEN
                    
                     //$bucketLink= $json['links']['bucket'];
                     //zenodoid=10885006
                            
                    			 $bucketLink= "https://zenodo.org/api/files/15a8adb9-29d4-4a99-a1b0-77dec12c5cfd";
                    			               
                    			 $uploadUrl =$bucketLink."/".$fileName."?access_token=". $access_token;
                    			 
 
 
                 
                
                
                $fileName = $journalShortName . '_0611503.pdf';      
                $filePath = '../uploadfiles/' . $journalShortName . '_0611503.pdf';    			
                $token ='1wvmTGSnZ6WomgTYdNZscccx9Xs11MowcUGDZaa2p72N2NkQDjRtqmVQaSnZ';
                $bucketURL ='https://zenodo.org/api/files/15a8adb9-29d4-4a99-a1b0-77dec12c5cfd';
                
                
                */
                
                
                
                
                
                /*
                // Dosyayı oku
                $fileContent = file_get_contents($filePath);
                
                // Zenodo API'ye dosya yükleme URL'sini oluştur
                $url = $bucketURL . '/' . $fileName;
                
                // İstek ayarlarını oluştur
                $requestConfig = array(
                    'headers' => array(
                        'Content-Type' => 'application/pdf',
                    ),
                    'query' => array(
                        'access_token' => $token,
                    ),
                    'body' => $fileContent,
                                );
                
                // Zenodo API'ye istek gönder
                $response = file_put_contents($url, $fileContent, false, stream_context_create(array(
                    'http' => $requestConfig,
                )));
                
                if ($response !== false) {
                    echo "Dosya başarıyla yüklendi.";
                } else {
                    echo "Dosya yüklenirken bir hata oluştu.";
                }
                 
                 */


           /*



							$fileName = $journalShortName . '_0611503.pdf';      
							$filePath = '../uploadfiles/' . $journalShortName . '_0611503.pdf';    			
							$token = '1wvmTGSnZ6WomgTYdNZscccx9Xs11MowcUGDZaa2p72N2NkQDjRtqmVQaSnZ';
							$bucketURL = 'https://zenodo.org/api/files/15a8adb9-29d4-4a99-a1b0-77dec12c5cfd';

							 
							 echo "istek  1";

								$response = $client->request('POST', $bucketURL, [
														'headers' => [
															'Content-Type' => 'application/pdf',
															'Authorization' => 'Bearer ' . $token,
														],
														'multipart' => [
															[
																'name' => 'file',
																'contents' => fopen($filePath, 'r'),
																'filename' => $fileName,
															],
														],
													]);

					echo "istek gitti";
						// Yanıt işleme
				        $statusCode = $response->getStatusCode();
						$body = $response->getBody()->getContents();
						
						if ($statusCode == 200) {
							echo "Dosya başarıyla yüklendi.";
						} else {
							echo "Dosya yüklenirken bir hata oluştu.";
						}
					 




  



					*/ 
					
				  $processResultMessage="  The file process is problem.  ";
				}			
				
				
				
                   // $m = $processResultMessage . $json['metadata']['prereserve_doi']['doi'];
                    MesajGoster( $processResultMessage);
				 
					
				 
			   
			
		    


		
			if (isset($json['metadata']['prereserve_doi'])) {
				
				
				$doi = mysqli_real_escape_string($baglanti, $json['metadata']['prereserve_doi']['doi']);
				$zenodoResponse = mysqli_real_escape_string($baglanti, $data);
				$zenodoID = mysqli_real_escape_string($baglanti, $json['id']);
			  // UPDATE sorgusunu hazırlayın
				$update_query = "UPDATE submission_list SET doi='$doi', ZenodoResponse='$zenodoResponse', zenodoID='$zenodoID' WHERE id=$id";

				// UPDATE sorgusunu çalıştırın
				$update_result = mysqli_query($baglanti, $update_query);

						// UPDATE işleminin başarılı olup olmadığını kontrol edin
				if ($update_result) {
				//	echo "<h3>DOI has been recorded. You can see detail of papaer<br>";
				} else {
					echo "DOI has not been recorded. Error...: " . mysqli_error($baglanti);
				}
			} else {
						echo "DOI not found in response.\n";
			}

			$statusCode = $response->getStatusCode();

			if ($statusCode == 200) {
			 //   echo "<h4>MS information has been sent succesfully! <br>";
			} else {
			//	echo "Error while sending information . HTTP code: " . $statusCode;
					echo "HTTP code: " . $statusCode;
			}
		} catch (Exception $e) {
			echo "Error while requesting...... : " . $e->getMessage();
		}

		// Veritabanı bağlantısını kapatın
		mysqli_close($baglanti);


}else 
{
	
	MesajGoster("Errer No Selected paper");
				
}

?>
