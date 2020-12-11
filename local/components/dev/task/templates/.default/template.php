<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
$nav = $arResult['NAV']->GetPageNavStringEx($navComponentObject, "Страницы:", "show_more");
?>

<div class="task-main">
	<?foreach ($arResult["ITEMS"] as $value):?>
		<div class="task-item">
			<?if ($value["PREVIEW_PICTURE"]):?>
				<div class="task-img">
					<img src="<?=$value["PREVIEW_PICTURE"]?>" alt="Картинка <?=$value["NAME"]?>">
				</div>
			<?endif;?>
			<?if ($value["PREVIEW_TEXT"]):?>
				<div class="task-desc">
					<span><?=$value["PREVIEW_TEXT"]?></span>
				</div>
			<?endif;?>
			<?if ($value["NAME"]):?>
				<div class="task-name">
					<span><?=$value["NAME"]?></span>
				</div>
			<?endif;?>	
			<div class="task-vote" data-id="<?=$value["ID"]?>">
				<span class="vote-minus">-</span> <span class="vote-value"><?=($value["VOTE"]) ? $value["VOTE"] : 0;?></span> <span class="vote-plus">+</span>
			</div>
		</div>
	<?endforeach;?>
	<?=$nav;?>
</div>
