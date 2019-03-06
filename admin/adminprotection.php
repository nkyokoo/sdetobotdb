<?php

/*
 * This has to be applied to all admin pages.
 *
 * Brug $_SESSION['returntag'] for at tjekke med så du ikke skal lave en ny session variable, da du bruger session
 * returntag som gruppe id, ligesom i sidebar.php
 *
 * Pseudo Code ----------------------------------------------------------
 *
 * Check if user doesn't have admin access
 *      return to index.php
 * if user has admin access
 *      do nothing and let nature take its course-
 */