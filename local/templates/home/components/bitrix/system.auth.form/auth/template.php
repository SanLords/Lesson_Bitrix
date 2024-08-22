<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

CJSCore::Init();
?>

<div class="site-section">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-lg-8 mb-5">
        <?if($arResult["FORM_TYPE"] == "login"):?>
          <form name="system_auth_form<?=$arResult["RND"]?>" method="post" target="_top" action="<?=$arResult["AUTH_URL"]?>" class="p-5 bg-white border">
            <?if($arResult["BACKURL"] <> ''):?>
              <input type="hidden" name="backurl" value="<?=$arResult["BACKURL"]?>" />
            <?endif?>
            <?foreach ($arResult["POST"] as $key => $value):?>
              <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?endforeach?>
            <input type="hidden" name="AUTH_FORM" value="Y" />
            <input type="hidden" name="TYPE" value="AUTH" />

            <?if ($arResult['SHOW_ERRORS'] === 'Y' && $arResult['ERROR'] && !empty($arResult['ERROR_MESSAGE'])):?>
              <div class="alert alert-danger">
                <?=ShowMessage($arResult['ERROR_MESSAGE'])?>
              </div>
            <?endif?>

            <div class="row form-group">
              <div class="col-md-12 mb-3 mb-md-0">
                <label class="font-weight-bold" for="USER_LOGIN"><?=GetMessage("AUTH_LOGIN")?></label>
                <input type="text" id="USER_LOGIN" name="USER_LOGIN" maxlength="50" value="" class="form-control" placeholder="Login">
              </div>
            </div>
            <div class="row form-group">
              <div class="col-md-12">
                <label class="font-weight-bold" for="USER_PASSWORD"><?=GetMessage("AUTH_PASSWORD")?></label>
                <input type="password" id="USER_PASSWORD" name="USER_PASSWORD" maxlength="255" class="form-control" autocomplete="off" placeholder="Password">
              </div>
            </div>

            <?if ($arResult["STORE_PASSWORD"] == "Y"):?>
              <div class="row form-group">
                <div class="col-md-12">
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y">
                    <label class="form-check-label" for="USER_REMEMBER_frm"><?echo GetMessage("AUTH_REMEMBER_SHORT")?></label>
                  </div>
                </div>
              </div>
            <?endif?>

            <?if($arResult["CAPTCHA_CODE"]):?>
              <div class="row form-group">
                <div class="col-md-12">
                  <label class="font-weight-bold" for="captcha_word"><?echo GetMessage("AUTH_CAPTCHA_PROMT")?></label>
                  <input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
                  <img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="180" height="40" alt="CAPTCHA" />
                  <input type="text" id="captcha_word" name="captcha_word" maxlength="50" value="" class="form-control" placeholder="Enter CAPTCHA" />
                </div>
              </div>
            <?endif?>

            <div class="row form-group">
              <div class="col-md-12">
                <input type="submit" name="Login" value="<?=GetMessage("AUTH_LOGIN_BUTTON")?>" class="btn btn-primary py-2 px-4 rounded-0">
              </div>
            </div>
          </form>
        <?else:?>
          <div class="p-5 bg-white border">
            <h4><?=$arResult["USER_NAME"]?></h4>
            <p>[<?=$arResult["USER_LOGIN"]?>]</p>
            <a href="<?=$arResult["PROFILE_URL"]?>" class="btn btn-primary py-2 px-4 rounded-0"><?=GetMessage("AUTH_PROFILE")?></a>
            <form action="<?=$arResult["AUTH_URL"]?>" method="post">
              <?foreach ($arResult["GET"] as $key => $value):?>
                <input type="hidden" name="<?=$key?>" value="<?=$value?>" />
              <?endforeach?>
              <?=bitrix_sessid_post()?>
              <input type="hidden" name="logout" value="yes" />
              <input type="submit" name="logout_butt" value="<?=GetMessage("AUTH_LOGOUT_BUTTON")?>" class="btn btn-secondary py-2 px-4 rounded-0">
            </form>
          </div>
        <?endif?>
      </div>
    </div>
  </div>
</div>