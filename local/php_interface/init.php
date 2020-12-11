<?
AddEventHandler('iblock', 'OnIBlockElementDelete', 'VoteMail');

function VoteMail (&$itemId)
{ 
  $vote = 0;
  $itemVote = false; 

  if (CModule::IncludeModule("iblock"))
  {
    global $USER;
    if (!is_object($USER)) 
    {
      $USER = new CUser();
    }

    $resId = CIBlockElement::GetByID($itemId);
    if ($ar_resID = $resId->GetNext())
      $item_iblock = $ar_resID["IBLOCK_ID"];

    $arSelect = Array("ID", "NAME", "CODE", "PROPERTY_VOTE_COUNT");
    $arFilter = Array("IBLOCK_ID" => $item_iblock);
    
    $res = CIBlockElement::GetList(Array(), $arFilter, false,  Array (), $arSelect);
    for ($i = 0; $ob = $res->GetNextElement(); $i++) {
          $arFields = $ob->GetFields();
          if ($arFields["PROPERTY_VOTE_COUNT_VALUE"] > $vote) {
            $vote = $arFields["PROPERTY_VOTE_COUNT_VALUE"];
          }
          if ($arFields["ID"] == $itemId) {
            $itemVote = $arFields["PROPERTY_VOTE_COUNT_VALUE"];
            $itemName = $arFields["NAME"];
          }     
      };
  }
  
  if ($itemVote == $vote) {
    $to  = COption::GetOptionString("main", "email_from"); 
    $mail = COption::GetOptionString("main", "email_from"); 
    $subject = "На вашем сайте удалили элемент " . $itemName . " с наибольшим кол-вом голосов"; 
    $message = "Элемент " . $itemName . " набрал наибольшие кол-во голосов: " . $itemVote;
    $headers = 'From: ' . $mail . "\r\n" .
        'Reply-To: ' . $mail . "\r\n" .
        'X-Mailer: PHP/' . phpversion();

    mail($to, $subject, $message, $headers); 
  }
}

?>