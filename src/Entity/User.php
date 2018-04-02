<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;
    
    /**
     * @ORM\Column(type="string",length=50)
     */
    private $firstName;
    
    
    /**
     * @ORM\Column(type="string",length=50)
     */
    private $lastName;
    
    /**
     * @ORM\Column(type="string",length=50)
     */
    private $address;
    

    public function setFirstName($firstName){
    	$this->firstName = $firstName;
    }
    
    public function setLastName($lastName){
    	$this->lastName = $lastName;
    }
    
    public function setAddress($address){
    	$this->address = $address;
    }
    
    
    public function getId(){
    	return $this->id;
    }
    
    
    public function getFirstName(){
    	return $this->firstName;
    }
    
    public function getLastName(){
    	return $this->lastName;
    }
    
    public function getAddress(){
    	return $this->address;
    }
    
    // add your own fields
}
