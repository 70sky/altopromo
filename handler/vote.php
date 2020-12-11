<?
require($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
CModule::IncludeModule("iblock");

$arEventFields = array (
    "PROP" => htmlspecialcharsbx($_POST["PROP"]),
    "ID" => htmlspecialcharsbx($_POST["ID"]),
    "VALUE" => htmlspecialcharsbx($_POST["VALUE"])
);

$ELEMENT_ID = $arEventFields["ID"];
$PROPERTY_CODE = $arEventFields["PROP"]; 
$PROPERTY_VALUE = $arEventFields["VALUE"];

CIBlockElement::SetPropertyValuesEx($ELEMENT_ID, false, array($PROPERTY_CODE => $PROPERTY_VALUE));
?>