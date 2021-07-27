
 <?php get_header(); ?>
<div id="main-content">
		<div id="content-full">
<!-- The above div added and probably unique to theme or may vary in location on other themes -->
<!-- show registration form, but only if we didn't submit already -->
<img width="100%" src="https://bitcoin101.today/views/bitcoin101logo.png" id="bg" alt="">


<!-- clean separation of HTML and PHP -->
<h2><?php echo htmlspecialchars($_SESSION['user_name']); ?> <?php echo WORDING_EDIT_YOUR_CREDENTIALS; ?></h2>

<!-- edit form for username / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="/members-edit" name="user_edit_form_name">
    <label for="user_name"><?php echo WORDING_NEW_USERNAME; ?></label>
    <input id="user_name" type="text" name="user_name" pattern="[a-zA-Z0-9]{2,64}" required /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo htmlspecialchars($_SESSION['user_name']); ?>)
    <input type="submit" name="user_edit_submit_name" value="<?php echo WORDING_CHANGE_USERNAME; ?>" />
</form><hr/>

<!-- edit form for user email / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="/members-edit" name="user_edit_form_email">
    <label for="user_email"><?php echo WORDING_NEW_EMAIL; ?></label>
    <input id="user_email" type="email" name="user_email" required /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo htmlspecialchars($_SESSION['user_email']); ?>)
    <input type="submit" name="user_edit_submit_email" value="<?php echo WORDING_CHANGE_EMAIL; ?>" />
</form><hr/>

<!-- edit form for user wdgts_lnk_num / this form uses HTML5 attributes, like "required" and type="email" -->
<form method="post" action="/members-edit" name="user_edit_form_wdgts_lnk_num">
    <label for="wdgts_lnk_num"><?php echo 'WORDING_wdgts_lnk_num'; ?></label>
    <input id="wdgts_lnk_num" type="text" name="wdgts_lnk_num"  /> (<?php echo WORDING_CURRENTLY; ?>: <?php echo htmlspecialchars($_SESSION['user_email']); ?>)
    <input type="submit" name="user_edit_submit_wdgts_lnk_num" value="<?php echo 'WORDING_CHANGE_wdgts_lnk_num'; ?>" />
</form><hr/>





<!-- edit form for user's password / this form uses the HTML5 attribute "required" -->
<form method="post" action="/members-edit" name="user_edit_form_password">
    <label for="user_password_old"><?php echo WORDING_OLD_PASSWORD; ?></label>
    <input id="user_password_old" type="password" name="user_password_old" autocomplete="off" />

    <label for="user_password_new"><?php echo WORDING_NEW_PASSWORD; ?></label>
    <input id="user_password_new" type="password" name="user_password_new" autocomplete="off" />

    <label for="user_password_repeat"><?php echo WORDING_NEW_PASSWORD_REPEAT; ?></label>
    <input id="user_password_repeat" type="password" name="user_password_repeat" autocomplete="off" />

    <input type="submit" name="user_edit_submit_password" value="<?php echo WORDING_CHANGE_PASSWORD; ?>" />
</form><hr/>

<!-- backlink -->
<a href="/login"><?php echo WORDING_BACK_TO_LOGIN; ?></a>

</div>
<table class="center" width ="60%"><tbody>
                                <tr  bgcolor="#000000" colspan="3">
<td style="text-align:center;"><a href="/login/"><button class="buttonl"><span>Member Home</span></button></a></td> 
<td style="text-align:center;"><a href="/login/?logout"><button class="button"><span>Log Out</span></button></a></td>
<!--<td style="text-align:center;"><a href="https://bitcoin101.today/more-info-wallet-max"><button class="button"><span>Edit Profile</span></button></a></td>
<td style="text-align:center;"><a href="https://bitcoin101.today/lesson-five/"><button class="button"><span>Next Lesson</span></button></a></td>-->
                                            </tr>
                                        </tbody>
                                    </table>
</div>

<!--  The above div added and probably unique to theme or may vary in location on other themes -->
  <?php //get_sidebar(); 
  get_footer(); ?>
