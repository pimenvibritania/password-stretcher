<?php

namespace pimenvibritania\PasswordStretcher;

require_once 'src/PasswordStorage.php';

// At the end is "WHITE SMILING FACE", in UTF-8, which fits into a single UTF-16
// character, allowing implementations to compare against the length.
$testPassword = "password\xE2\x98\xBA";
$length = mb_strlen($testPassword, 'UTF-8');
echo $length . " ".  $testPassword . " " . PasswordStorage::create_hash($testPassword) . "\n";

