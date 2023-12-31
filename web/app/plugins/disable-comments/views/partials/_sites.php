<div class="">
<div class="d__flex mb15 space__between">
    <div class='subsite__checklist__item' style="flex: 1 1 200px;">
        <input
            type='checkbox'
            class='check-all'
            id='sites__option__<?php echo $type;?>__check__all'
            name='disabled_sites[all]'
            value='1'
        >
        <label for='sites__option__<?php echo $type;?>__check__all'>
            <b><?php _e('Select All', 'disable-comments'); ?></b>
            <small>(0 selected)</small>
        </label>
    </div>
    <div class="mb10" style="text-align: right; flex: 0 0 230px;">
        <div class="icon__input sub__site_control">
            <span class="icon">
                <img src="<?php echo esc_url(DC_ASSETS_URI . 'img/search.svg'); ?>" alt="">
            </span>
            <input type="text" class="form__control w-100 sub-site-search" placeholder="Search by domain name..." style="padding-right: 35px;">
        </div>
    </div>
</div>
<div class="sites_list">
    <div class="nothing-found"><p>No subsite found</p></div>
</div>
<div class="d__flex space__between">
    <div class="d__flex item__number__controller sub__site_control page__size__wrapper">
        <p>Show Items:</p>
        <div class="dc-select">
            <span class="icon"></span>
            <select class="form__control page__size">
                <!-- <option value="2">2</option> -->
                <!-- <option value="10">10</option> -->
                <option value="20">20</option>
                <option value="50" selected>50</option>
                <option value="100">100</option>
                <option value="200">200</option>
            </select>
        </div>
    </div>
    <div class="has-pagination"></div>
</div>
</div>

