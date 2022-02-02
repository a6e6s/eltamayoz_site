<?php
/*
 * @Developed by : Ahmed Abd Elhaliem .
 * @Developer Site: http//www.elmosamem.com 
 */
?>
<div id="sidebar" class="sidebar responsive sidebar-fixed sidebar-scroll">
    <ul class="nav nav-list">
<!--        <li class="<?php // echo (isset($name_page[0]) && $name_page[0] == 'dashboard' || $name_page[0] == 'index' || !isset($name_page[0])) ? "active" : null; ?>">
            <a href="<?php // echo ADMIN_URL ?>dashboard">
                <i class="menu-icon fa fa-tachometer"></i>
                <span class="menu-text"> Dashboard </span>
            </a>
        </li>-->
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'sites') ? "active" : null; ?>">
            <a href="<?php echo ADMIN_URL; ?>sites">
                <i class="menu-icon fa fa-sitemap"></i>
                <span class="menu-text"> Sites </span>
            </a>
        </li>
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'works') ? "active open" : null; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-image"></i>
                <span class="menu-text">Our Works</span>
                <i class="arrow fa fa-angle-down"></i>
            </a>
            <ul class="submenu">
                <li class="<?php echo (isset($name_page[1]) && $name_page[1] == 'items' || isset($name_page[1]) && $name_page[1] == 'edit_item' || isset($name_page[1]) && $name_page[1] == 'new_item') ? "active" : null; ?>">
                    <a href="<?php echo ADMIN_URL ?>works/items">
                        <i class="menu-icon fa fa-caret-right"></i>Works
                    </a>
                </li>
                <li class="<?php echo (isset($name_page[1]) && $name_page[1] == 'tags' || isset($name_page[1]) && $name_page[1] == 'new_tag' || isset($name_page[1]) && $name_page[1] == 'edit_tag') ? "active" : null; ?>">
                    <a href="<?php echo ADMIN_URL ?>works/tags">
                        <i class="menu-icon fa fa-caret-right"></i>Tags
                    </a>
                </li>
            </ul>
        </li>
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'clients') ? "active" : null; ?>">
            <a href="<?php echo ADMIN_URL ?>clients">
                <i class="menu-icon fa fa-apple"></i>
                <span class="menu-text"> Clients </span>
            </a>
        </li>
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'slideshow') ? "active" : null; ?>">
            <a href="<?php echo ADMIN_URL ?>slideshow">
                <i class="menu-icon fa fa-sliders"></i>
                <span class="menu-text"> Slideshow </span>
            </a>
        </li>
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'pages' ) ? "active" : null; ?>">
            <a href="<?php echo ADMIN_URL ?>pages">
                <i class="menu-icon fa fa-file-o"></i>
                <span class="menu-text">Pages</span>
            </a>
        </li>
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'blog') ? "active open" : null; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-pencil"></i>
                <span class="menu-text">Blog</span>
                <i class="arrow fa fa-angle-down"></i>
            </a>
            <ul class="submenu">
                <li class="<?php echo (isset($name_page[1]) && $name_page[1] == 'articles' || isset($name_page[1]) && $name_page[1] == 'new_article' || isset($name_page[1]) && $name_page[1] == 'edit_article' ) ? "active" : null; ?>">
                    <a href="<?php echo ADMIN_URL ?>blog/articles">
                        <i class="menu-icon fa fa-caret-right"></i>Articles
                    </a>
                </li>
                <li class="<?php echo (isset($name_page[1]) && $name_page[1] == 'categories' || isset($name_page[1]) && $name_page[1] == 'new_category' || isset($name_page[1]) && $name_page[1] == 'edit_category' ) ? "active" : null; ?>">
                    <a href="<?php echo ADMIN_URL ?>blog/categories">
                        <i class="menu-icon fa fa-caret-right"></i>Categories
                    </a>
                </li>
                <li class="<?php echo (isset($name_page[1]) && $name_page[1] == 'tags' || isset($name_page[1]) && $name_page[1] == 'new_tag' || isset($name_page[1]) && $name_page[1] == 'edit_tag' ) ? "active" : null; ?>">
                    <a href="<?php echo ADMIN_URL ?>blog/tags">
                        <i class="menu-icon fa fa-caret-right"></i>Tags
                    </a>
                </li>
                <li class="<?php echo (isset($name_page[1]) && $name_page[1] == 'comments' || isset($name_page[1]) && $name_page[1] == 'edit_comment' ) ? "active" : null; ?>">
                    <a href="<?php echo ADMIN_URL ?>blog/comments">
                        <i class="menu-icon fa fa-caret-right"></i>Comments
                    </a>
                </li>
            </ul>
        </li>
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'menus' ) ? "active" : null; ?>">
            <a href="<?php echo ADMIN_URL ?>menus">
                <i class="menu-icon fa fa-list"></i>
                <span class="menu-text"> Menus </span>
            </a>
        </li>
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'quiz' ) ? "active" : null; ?>">
            <a href="<?php echo ADMIN_URL ?>quiz">
                <i class="menu-icon fa fa-question-circle"></i>
                <span class="menu-text">Quiz</span>
            </a>
        </li>
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'users') ? "active" : null; ?>">
            <a href="<?php echo ADMIN_URL ?>users">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">Users</span>
            </a>
        </li>
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'messages') ? "active" : null; ?>">
            <a href="<?php echo ADMIN_URL ?>messages">
                <i class="menu-icon fa fa-envelope-o"></i>
                <span class="menu-text">Messages</span>
            </a>
        </li>
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'requests') ? "active" : null; ?>">
            <a href="<?php echo ADMIN_URL ?>requests">
                <i class="menu-icon fa fa-shopping-cart"></i>
                <span class="menu-text">Requests</span>
            </a>
        </li>
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'languages') ? "active" : null; ?>">
            <a href="<?php echo ADMIN_URL ?>languages">
                <i class="menu-icon fa fa-language"></i>
                <span class="menu-text"> languages </span>
            </a>
        </li>
        <li class="<?php echo (isset($name_page[0]) && $name_page[0] == 'settings') ? "active open" : null; ?>">
            <a href="#" class="dropdown-toggle">
                <i class="menu-icon fa fa-cog"></i>
                <span class="menu-text"> Settings </span>
                <i class="arrow fa fa-angle-down"></i>
            </a>
            <ul class="submenu">
                <li class="<?php echo (isset($name_page[1]) && $name_page[1] == 'contacts') ? "active" : null; ?>">
                    <a href="<?php echo ADMIN_URL ?>settings/contacts">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Contacts
                    </a>
                </li>
                <li class="<?php echo (isset($name_page[1]) && $name_page[1] == 'requests') ? "active" : null; ?>">
                    <a href="<?php echo ADMIN_URL ?>settings/requests">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Requests
                    </a>
                </li>
                <li class="<?php echo (isset($name_page[1]) && $name_page[1] == 'mail') ? "active" : null; ?>">
                    <a href="<?php echo ADMIN_URL ?>settings/mail">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Mail
                    </a>
                </li>
                <li class="<?php echo (isset($name_page[1]) && $name_page[1] == 'social') ? "active" : null; ?>">
                    <a class="" href="<?php echo ADMIN_URL ?>settings/social">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Social
                    </a>
                </li>
                <li class="<?php echo (isset($name_page[1]) && $name_page[1] == 'blog') ? "active" : null; ?>">
                    <a class="" href="<?php echo ADMIN_URL ?>settings/blog">
                        <i class="menu-icon fa fa-caret-right"></i>
                        Blog
                    </a>
                </li>
            </ul>
        </li>
    </ul><!-- /.nav-list -->

    <div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
        <i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
    </div>
</div>