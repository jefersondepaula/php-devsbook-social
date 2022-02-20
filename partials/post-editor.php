<?php $firstName = current(explode(' ', $userInfo->name)); ?>

<div class="box feed-new">
    <div class="box-body">
        <div class="feed-new-editor m-10 row">
            <div class="feed-new-avatar">
                <img src="<?=$base?>media/avatars/<?=$userInfo->avatar?>" />
            </div>
            <div class="feed-new-input-placeholder">O que você está pensando, <?=$firstName?>?</div>
            <div class="feed-new-input" contenteditable="true"></div>
            <div class="feed-new-send">
                <img src="<?=$base?>assets/images/send.png" />
            </div>
            <form class="feed-new-post" method="POST" action="<?=$base?>postEditorAction.php">
                <input type="hidden" name="postBody">
            </form>
        </div>
    </div>
</div>
<script>
    let postInput = document.querySelector('.feed-new-input');
    let postSubmit = document.querySelector('.feed-new-send');
    let postForm = document.querySelector('.feed-new-post');

    postSubmit.addEventListener('click', () => {
       let value = postInput.innerText.trim();

       postForm.querySelector('input[name=postBody]').value = value;
       postForm.submit();
    });

</script>