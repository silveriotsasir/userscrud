<?php

/**
 * Created by PhpStorm.
 * User: Silverio
 * Date: 18/01/2017
 * Time: 8:34
 */
class User
{
    var $id;
    var $username;
    var $password;
    var $name;
    var $surnames;
    var $email;

     /**
     * User constructor.
     * @param $password
     */
    public function __construct($user_array)
    {
        $this->id = $user_array['id'];
        $this->username = $user_array['username'];
        $this->password = $user_array['password'];
        $this->name = $user_array['name'];
        $this->surnames = $user_array['surnames'];
        $this->email = $user_array['email'];
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password)
    {
        $this->password = $password;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $ame
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getSurnames()
    {
        return $this->surnames;
    }

    /**
     * @param mixed $surnames
     */
    public function setSurnames($surnames)
    {
        $this->surnames = $surnames;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

}