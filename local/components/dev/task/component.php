<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
use Bitrix\Main\Loader;

if(!Loader::includeModule("iblock"))
	return;

CPageOption::SetOptionString("main", "nav_page_in_session", "N");

$arSelect = Array("ID", "NAME", "CODE", "PREVIEW_PICTURE", "PREVIEW_TEXT", "PROPERTY_VOTE_COUNT");
$arFilter = Array("IBLOCK_ID" => IntVal($arParams["IBLOCK_ID"]), "ACTIVE"=>"Y");
$res = CIBlockElement::GetList(Array(), $arFilter, false, Array("nPageSize"=>10), $arSelect);

for ($i = 0; $ob = $res->GetNextElement(); $i++) {
	    $arFields = $ob->GetFields();
	    $arResult["ITEMS"][$i]["NAME"] = $arFields["NAME"];
	    $arResult["ITEMS"][$i]["ID"] = $arFields["ID"];
	    $arResult["ITEMS"][$i]["PREVIEW_TEXT"] = $arFields["PREVIEW_TEXT"];
	    $arResult["ITEMS"][$i]["VOTE"] = $arFields["PROPERTY_VOTE_COUNT_VALUE"];
	    $arResult["ITEMS"][$i]["PREVIEW_PICTURE"] = CFile::GetPath($arFields["PREVIEW_PICTURE"]);
	};

$arResult['NAV'] = $res;
$this->IncludeComponentTemplate();

?>