<?php $url=url()->current(); ?>
<!--sidebar-menu-->
<div id="sidebar"><a href="#" class="visible-phone"><i class="icon icon-home"></i> Dashboard</a>
    <ul>
        <li <?php if (preg_match("/dashboard/i", $url)){ ?> class="active" <?php } ?>>
            <a href="{{ url('/admin/dashboard') }}"><i class="icon icon-home"></i> <span>Dashboard</span></a> </li>

        @if(Session::get('adminDetails')['categories_full_access']==1 ||
            Session::get('adminDetails')['categories_edit_access']==1 ||
            Session::get('adminDetails')['categories_view_access']==1)
            <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i><span>Marchi e Piattaforme</span> <span class="label label-important"></span></a>
                <ul <?php if (preg_match("/category/i", $url)){ ?> style="display: block;" <?php } ?>>
                    @if(Session::get('adminDetails')['categories_edit_access']==1 || Session::get('adminDetails')['categories_full_access']==1)
                <li <?php if (preg_match("/add-category/i", $url)){ ?> class="active" <?php } ?>>
                    <a href="{{ url('/admin/add-category') }}">Aggiungi un Marchio e/o una Piattaforma</a></li>
                    @endif
                        @if(Session::get('adminDetails')['categories_full_access']==1 ||
                Session::get('adminDetails')['categories_edit_access']==1 ||
                Session::get('adminDetails')['categories_view_access']==1)
                <li <?php if (preg_match("/view_categories/i", $url)){ ?> class="active" <?php } ?>>
                    <a href="{{ url('/admin/view-categories') }}">Vedi Marchi e Piattaforme</a></li>
                        @endif
                </ul>
            </li>
        @endif
        @if(Session::get('adminDetails')['products_access']==1)
            <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Videogiochi</span> <span class="label label-important"></span></a>
                <ul  <?php if (preg_match("/product/i", $url)){ ?> style="display: block;" <?php } ?>>
                <li <?php if (preg_match("/add-product/i", $url)){ ?> class="active" <?php } ?>>
                    <a href="{{ url('/admin/add-product') }}">Aggiungi Videogiochi</a></li>
                <li <?php if (preg_match("/view-products/i", $url)){ ?> class="active" <?php } ?>>
                    <a href="{{ url('/admin/view-products') }}">Vedi Viedeogiochi</a></li>
                </ul>
            </li>
        @endif
        @if(Session::get('adminDetails')['type']=="Admin")
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Coupon</span> <span class="label label-important"></span></a>
            <ul <?php if (preg_match("/coupon/i", $url)){ ?> style="display: block;" <?php } ?>>
                <li <?php if (preg_match("/add-coupons/i", $url)){ ?> class="active" <?php } ?>>
                    <a href="{{ url('/admin/add-coupon') }}">Aggiungi Coupon</a></li>
                <li <?php if (preg_match("/view-coupons/i", $url)){ ?> class="active" <?php } ?>>
                    <a href="{{ url('/admin/view-coupons') }}">Vedi Coupon</a></li>
            </ul>
        </li>
        @endif
        @if(Session::get('adminDetails')['orders_access']==1)
            <?php
            $base_order_url = trim(basename($url));
            ?>
            <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Ordini</span> <span class="label label-important"></span></a>
                <ul <?php if (preg_match("/orders/i", $url)){ ?> style="display: block;" <?php } ?>>
                <li <?php if ($base_order_url=="view-orders"){ ?> class="active" <?php } ?>>
                    <a href="{{ url('/admin/view-orders') }}">Vedi Ordini</a></li>
                <li <?php if ($base_order_url=="view-orders-charts"){ ?> class="active" <?php } ?>>
                    <a href="{{ url('/admin/view-orders-charts') }}">Vedi Grafico Ordini</a></li>
                </ul>
            </li>
        @endif
        @if(Session::get('adminDetails')['users_access']==1)
            <?php
                $base_user_url = trim(basename($url));
            ?>
        <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Utenti</span> <span class="label label-important"></span></a>
            <ul <?php if (preg_match("/users/i", $url)){ ?> style="display: block;" <?php } ?>>
                <li <?php if ($base_user_url=="view-users"){ ?> class="active" <?php } ?>>
                    <a href="{{ url('/admin/view-users') }}">Vedi Utenti</a></li>
                <li <?php if ($base_user_url=="view-users-charts"){ ?> class="active" <?php } ?>>
                    <a href="{{ url('/admin/view-users-charts') }}">Vedi Grafico Utenti </a></li>
                <!-- <li <?php if ($base_user_url=="view-users-countries-charts"){ ?> class="active" <?php } ?>>
                    <a href="{{ url('/admin/view-users-countries-charts') }}">Vedi Grafico Provenienza Utenti</a></li> -->
            </ul>
        </li>
        @endif
        @if(Session::get('adminDetails')['type']=="Admin")
            <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Admins/Sub-Admin</span> <span class="label label-important"></span></a>
                <ul <?php if (preg_match("/admins/i", $url)){ ?> style="display: block;" <?php } ?>>
                    <li <?php if (preg_match("/add-admin/i", $url)){ ?> class="active" <?php } ?>>
                        <a href="{{ url('/admin/add-admin') }}">Aggiungi Admin/Sub-Admin</a></li>
                    <li <?php if (preg_match("/view-admins/i", $url)){ ?> class="active" <?php } ?>>
                        <a href="{{ url('/admin/view-admins') }}">Vedi Admin/Sub-Admin</a></li>
                </ul>
            </li>
            <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>CMS Pages</span> <span class="label label-important"></span></a>
                <ul  <?php if (preg_match("/cms-page/i", $url)){ ?> style="display: block;" <?php } ?>>
                    <li <?php if (preg_match("/add-cms-page/i", $url)){ ?> class="active" <?php } ?>>
                        <a href="{{ url('/admin/add-cms-page') }}">Aggiungi CMS Page</a></li>
                    <li <?php if (preg_match("/view-cms-pages/i", $url)){ ?> class="active" <?php } ?>>
                        <a href="{{ url('/admin/view-cms-pages') }}">Vedi CMS Pages</a></li>
                </ul>
            </li>
            <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Valute</span> <span class="label label-important"></span></a>
                <ul  <?php if (preg_match("/currencies/i", $url)){ ?> style="display: block;" <?php } ?>>
                    <li <?php if (preg_match("/add-currency/i", $url)){ ?> class="active" <?php } ?>>
                        <a href="{{ url('/admin/add-currency') }}">Aggiungi Valuta</a></li>
                    <li <?php if (preg_match("/view-currencies/i", $url)){ ?> class="active" <?php } ?>>
                        <a href="{{ url('/admin/view-currencies') }}">Vedi Valuta</a></li>
                </ul>
            </li>
            <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Spedizioni</span> <span class="label label-important"></span></a>
                <ul  <?php if (preg_match("/shipping/i", $url)){ ?> style="display: block;" <?php } ?>>
                    <li <?php if (preg_match("/view-shipping/i", $url)){ ?> class="active" <?php } ?>>
                        <a href="{{ url('/admin/view-shipping') }}">Tasse Spedizione</a></li>
                </ul>
            </li>
            <li class="submenu"> <a href="#"><i class="icon icon-th-list"></i> <span>Iscritti Newsletter</span>
                    <span class="label label-important"></span></a>
                <ul  <?php if (preg_match("/newsletter-subscribers/i", $url)){ ?> style="display: block;" <?php } ?>>
                    <li <?php if (preg_match("/newsletter-subscribers/i", $url)){ ?> class="active" <?php } ?>>
                        <a href="{{ url('/admin/view-newsletter-subscribers') }}">Newsletter</a></li>
                </ul>
            </li>
        @endif
    </ul>
</div>
<!--sidebar-menu-->
