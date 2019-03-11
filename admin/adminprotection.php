<?php
session_start();
/*
 * This file has to be applied on all admin pages as the first line of code.
 *
 * Brug $_SESSION['user_groupe_id'] for at tjekke med så du ikke skal lave en ny session variable, da du bruger session
 * returntag som gruppe id, ligesom i sidebar.php
 *
 * Pseudo Code ----------------------------------------------------------
 *
 * Check if user doesn't have admin access
 *      return to index.php
 * if user has admin access
 *      do nothing and let nature take its course-
 */

// if usergroup is not set yet go back to index
if (!isset($_SESSION['user_groupe_id'])){
    header('location: ../index.php');
}

// if usergroup isn't right go back to index
if ($_SESSION['user_groupe_id'] !== 1){
    header('location: ../index.php');

}