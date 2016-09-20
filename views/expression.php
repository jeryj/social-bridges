<label class="exp">
    <input id="<?php echo $expression->get_name();?>" class="exp_input" type="radio" name="expression" value="<?php echo $expression->get_name();?>" />
    <img class="face" src="dist/img/<?php echo $expression->get_image();?>" alt="" />
    <span class="sr"><?php echo $expression->get_description();?></span>
</label>
