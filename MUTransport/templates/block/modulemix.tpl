{* Purpose of this template: Display items within a block (fallback template) *}
{pageaddvar name='javascript' value='zikula.ui'}
    <ul id="tabs_issue" class="z-tabs">
        <li class="tab mutransport_tab"><a href="#one">{gt text='News'}</a></li>
        <li class="tab mutransport_tab" ><a href="#two">{gt text='Comments'}</a></li>
    </ul>
    <div id="one">
    {foreach item='item' from=$newsitems}
    <div class="mutransport_newsitem">
    <a href="{modurl modname='news' type='user' func='display' sid=$item.sid}">{$item.title}</a><br />
    {$item.hometext|safetext|truncate:50} 
    </div> 
    {/foreach}
    </div>
    <div id="two">
    {foreach item='comment' from=$ezcommentsitems}
    <div class="mutransport_ezcommentsitem">
    <a href="{$comment.url}#comment{$comment.id}">{$comment.subject}</a><br />
    {$comment.comment|safetext|truncate:50}  
    </div>
    {/foreach}    
    </div>
    <script type="text/javascript">
    var tabs = new Zikula.UI.Tabs('tabs_issue');
    </script>
