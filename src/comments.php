<?php
/**
 * Created by PhpStorm.
 * User: matthieuparis
 * Date: 10/11/2018
 * Time: 14:54
 */
?>
<div class="row">
    <div class="col s12">
        <h5 class="center-align">Add a comment</h5>
    </div>
    <div class="col s3"></div>
    <form method="post" action="">
    <div class="col s6">
    <div class="input-field col s12">
    <i class="material-icons prefix">title</i>
    <input id="icon_prefix" type="text" class="validate" name="username" required>
    <label for="icon_prefix">Username</label>
</div>
<div class="input-field col s12">
    <div class="input-field col s12">
        <i class="material-icons prefix">textsms</i>
        <textarea id="textarea2" class="materialize-textarea" data-length="600" required name="content"></textarea>
        <label for="textarea2">Content</label>
    </div>
</div>
        <div class="input-field col s12">
            <button class="btn waves-effect waves-light right" type="submit">Submit
                <i class="material-icons right">send</i>
            </button>
        </div>
    </div>
    <div class="col s3"></div>
    </form>
</div>
