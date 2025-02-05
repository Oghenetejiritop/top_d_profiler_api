<?php

/**
 * model.php 
 * Script that interacts with the database
 * @author Oghenetejiri Peace Onosajerhe
 * @version 1.0
 * @package top_d_profiler_api
 */


include 'connect_db.php';
connectDatabase();

/**
 *  getCurrentUser: Retrieves the user ID, username, and user id; and set the data to respective sessions
 * @param string $name$userName
 */
function getCurrentUser($userName) {
    global $pdo;
    $query = "SELECT * FROM users WHERE username=?;";
    $statement = $pdo->prepare($query);
    $statement->execute([$userName]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    if($user) {
        $_SESSION['uid'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['password'] = $user['password'];
    }
}


/**
 *  create_account: Creates a new profile for  a user
 * @param string $fName
 * @param string $mName
 * @param string $lName
 * @param string $email
 * @param string $phoneNum
 * @param string $userName
 * @param string $password
 * @param string $birtheDate
 * @param string $gender
 * @param string $country
 * @param string  $state_prov
 * @param string $city
 * @param string $street
 * @param string $postalCode
 * @return bool
 */
    function create_account($fName, $mName, $lName, $email, $phoneNum, $userName, $password, $birtheDate, $gender, $country, $state_prov, $city, $street, $postalCode) {
    global $pdo;
    $query = "INSERT INTO users (username, password) VALUES (?,?);";
    $statement = $pdo->prepare($query);
    $statement->execute([$userName, password_hash($password, PASSWORD_DEFAULT)]);
    getCurrentUser($userName);

    if(isset($_SESSION['uid'])) {
        $uid = (int) $_SESSION['uid'];
        $queryCreateAccount = "INSERT INTO account(user_id, firstname, middlename, lastname, email, phone_no, birthdate, gender) VALUES (?,?,?,?,?,?,?,?);";
        $queryCreateAccount .= "INSERT INTO countries(user_id, country) VALUES (?,?);";
        $queryCreateAccount .= "INSERT INTO Addresses(user_id, country, state_prov, city, street, postal_code) VALUES (?,?,?,?,?,?);";
        $statementInsertion = $pdo->prepare($queryCreateAccount);
        $statementInsertion->execute([$uid, $fName, $mName, $lName, $email, $phoneNum, $birtheDate, $gender, $uid, $country, $uid, $country, $state_prov, $city, $street, $postalCode]);
        return true;
        }
    return  false;
}


/**
 *  access_account: Retreives data of the user
 * @param string $userName
 * @return array
 */
function access_account($userName) {
    global $pdo;
    $currentUser = [];
    getCurrentUser($userName);
 
    if(isset($_SESSION['uid'])) {
        $query = "SELECT u.username, a.firstname, a.middlename, a.lastname, a.email, a.phone_no, a.birthdate, a.gender,  ad. street, ad.city, ad.postal_code, ad.state_prov, ad.country ";
        $query .= "FROM users u INNER JOIN account a ON u.user_id = a.user_id INNER JOIN addresses ad ON ad.user_id = u.user_id WHERE u.username=?;";
        $statement = $pdo->prepare($query);
        $statement->execute([$userName]);
        $currentUser = $statement->fetch(PDO::FETCH_ASSOC);
    }

    return $currentUser;
}


/**
 *  update_account: Modifies or edit user's profile
 * @return void
 */
function update_account() {
    return;
}


/**
 *  delete_account: Delete the user's profile
 * @return void
 */
function delete_account() {
    return;
}


?>