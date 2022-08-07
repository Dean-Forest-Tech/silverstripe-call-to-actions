<% with $AddExtraClass('btn btn-primary btn-lg') %>
    <% if LinkURL %>
        <a{$IDAttr}{$ClassAttr} href="{$LinkURL}"{$TargetAttr}>
            {$Title}
        </a>
    <% end_if %>
<% end_with %>