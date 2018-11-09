<?php
/**
 * Created by PhpStorm.
 * User: matthieuparis
 * Date: 09/11/2018
 * Time: 21:05
 */

include 'header.php'
?>

<section>
    <div class="row">
        <div class="col s12">
            <h4 class="center-align">Connection</h4>
        </div>
        <div class="col s3"></div>
            <form class="col s6">
                    <div class="input-field col s12">
                        <i class="material-icons prefix">account_circle</i>
                        <input id="icon_prefix" type="text" class="validate">
                        <label for="icon_prefix">Login</label>
                    </div>
                    <div class="input-field col s12">
                        <i class="material-icons prefix">https</i>
                        <input id="icon_https" type="tel" class="validate">
                        <label for="icon_https">Password</label>
                    </div>
                <div class="input-field col s12">
                <button class="btn waves-effect waves-light right" type="submit">Submit
                    <i class="material-icons right">send</i>
                </button>
                </div>
            </form>
        <div class="col s3"></div>

    </div>
</section>


<?php
include 'footer.php'
?>
