<?
if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();
?>

        <form action="<?=POST_FORM_ACTION_URI?>" method="POST" class="p-5 bg-white border">
          <?=bitrix_sessid_post()?>
          <?if(!empty($arResult["ERROR_MESSAGE"])):?>
            <?foreach($arResult["ERROR_MESSAGE"] as $v):?>
              <div class="alert alert-danger"><?=ShowError($v)?></div>
            <?endforeach;?>
          <?endif;?>
          <?if(!empty($arResult["OK_MESSAGE"])):?>
            <div class="alert alert-success"><?=$arResult["OK_MESSAGE"]?></div>
          <?endif;?>
          <div class="row form-group">
            <div class="col-md-12 mb-3 mb-md-0">
              <label class="font-weight-bold" for="fullname"><?=GetMessage("MFT_NAME")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("NAME", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
              <input type="text" id="fullname" name="user_name" class="form-control" value="<?=$arResult["AUTHOR_NAME"]?>">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <label class="font-weight-bold" for="email"><?=GetMessage("MFT_EMAIL")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("EMAIL", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
              <input type="text" id="email" name="user_email" class="form-control" value="<?=$arResult["AUTHOR_EMAIL"]?>">
            </div>
          </div>
          <div class="row form-group">
            <div class="col-md-12">
              <label class="font-weight-bold" for="message"><?=GetMessage("MFT_MESSAGE")?><?if(empty($arParams["REQUIRED_FIELDS"]) || in_array("MESSAGE", $arParams["REQUIRED_FIELDS"])):?><span class="mf-req">*</span><?endif?></label>
              <textarea name="MESSAGE" id="message" rows="5" class="form-control"><?=($arResult["MESSAGE"] ?? '')?></textarea>
            </div>
          </div>
          <?if($arParams["USE_CAPTCHA"] == "Y"):?>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold"><?=GetMessage("MFT_CAPTCHA")?></label>
                <input type="hidden" name="captcha_sid" value="<?=$arResult["capCode"]?>">
                <img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult["capCode"]?>" width="180" height="40" alt="CAPTCHA">
                <label class="font-weight-bold"><?=GetMessage("MFT_CAPTCHA_CODE")?><span class="mf-req">*</span></label>
                <input type="text" name="captcha_word" size="30" maxlength="50" value="">
              </div>
            </div>
          <?endif;?>
          <input type="hidden" name="PARAMS_HASH" value="<?=$arResult["PARAMS_HASH"]?>">
          <div class="row form-group">
            <div class="col-md-12">
              <input type="submit" name="submit" value="<?=GetMessage("MFT_SUBMIT")?>" class="btn btn-primary  py-2 px-4 rounded-0">
            </div>
          </div>
        </form>
  