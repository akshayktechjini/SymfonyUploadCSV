<?php
namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UploadUserController extends Controller
{
	/**
	 * @Route("/process-csv-file", name="process_csv_file")
	 */
	public function index(Request $request)
	{
		$file= $request->files->get("csvFile");
		$tempDir = $this->container->getParameter('kernel.root_dir') . '/../public/';
		$tempFileName = md5(uniqid()) . '.csv';
		$file->move($tempDir, $tempFileName);
		$fileFullPath = $tempDir . $tempFileName;
		chmod($fileFullPath, 0777);
		$fileToRead = fopen($fileFullPath, "r");
		$rowCount = 1;
		$entityManager = $this->getDoctrine()->getManager();
		while (!feof($fileToRead)) {
			$data = fgetcsv($fileToRead);
			if($rowCount !=1){
				$firstName = $data[0];
				$lastName = $data[1];
				$address = $data[2];
				$user = new User();
				$user->setFirstName($firstName);
				$user->setLastName($lastName);
				$user->setAddress($address);
				// tell Doctrine you want to (eventually) save the User (no queries yet)
				$entityManager->persist($user);
					
				// actually executes the queries (i.e. the INSERT query)
				$entityManager->flush();
					
				var_dump('Saved new User with id '.$user->getId()."<br/>");
				
			}
				$rowCount++;
		}
		 $response = "File upload successful <br/>" . $rowCount . "entries were added to the database";
         fclose($fileToRead);
         unlink($fileFullPath);
         return new Response($response);
	}

	/**
	 * @Route("/upload-user", name="upload_user")
	 */
	public function uploadUser(){
		return $this->render('user/index.html.twig');
	}

}
