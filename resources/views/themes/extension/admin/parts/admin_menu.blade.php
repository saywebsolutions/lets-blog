<?php

//  $rp = '/' . \Request::path();
  $rp = '/' . \Request::segment(2);

?>

<ul id="admin-sidebar" class="nav nav-pills nav-stacked">
  <li @if ($rp == '/') class="active" @endif ><a href="/admin">Admin Home</a></li>
  <li @if ($rp == '/posts') class="active" @endif ><a href="/admin/posts">Posts</a></li>
  <li @if ($rp == '/tags') class="active" @endif ><a href="/admin/tags">Tags</a></li>
</ul>
