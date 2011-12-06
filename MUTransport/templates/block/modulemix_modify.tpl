{* Purpose of this template: Edit block for generic item list *}

<div class="z-formrow">
    <label for="MUTransport_modules">{gt text='News'}:</label>
    {if $news eq 1}
    <input type="checkbox" id="MUTransport_modules" name="news" value="1" checked=checked>
    {else}
    <input type="checkbox" id="MUTransport_modules" name="news" value="1">
    {/if}
</div>
<div class="z-formrow">
    <label for="MUTransport_modules">{gt text='News Amount'}:</label>
    <input type="text" id="MUTransport_modules" name="newsamount" value="{$newsamount}">
</div>
<div class="z-formrow">
    <label for="MUTransport_modules">{gt text='Comments'}:</label>
    {if $comments eq 1}
    <input type="checkbox" id="MUTransport_modules" name="comment" value="1" checked=checked>
    {else}
    <input type="checkbox" id="MUTransport_modules" name="comments" value="1">
    {/if}
</div>
<div class="z-formrow">
    <label for="MUTransport_modules">{gt text='Comments Amount'}:</label>
    <input type="text" id="MUTransport_modules" name="commentsamount" value="{$commentsamount}">
</div>
