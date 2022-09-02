<?php

namespace App\Enums;

enum CatalogPageLayoutEnum : string
{
    case DEFAULT_3X3 = "default_3x3";
    case CLUB_BUY = "club_buy";
    case CLUB_GIFT = "club_gift";
    case FRONTPAGE = "frontpage";
    case SPACES = "spaces";
    case RECYCLER = "recycler";
    case RECYCLER_INFO = "recycler_info";
    case RECYCLER_PRIZES = "recycler_prizes";
    case TROPHIES = "trophies";
    case PLASTO = "plasto";
    case MARKETPLACE = "marketplace";
    case MARKETPLACE_OWN_ITEMS = "marketplace_own_items";
    case SPACES_NEW = "spaces_new";
    case SOUNDMACHINE = "soundmachine";
    case GUILDS = "guilds";
    case GUILD_FURNI = "guild_furni";
    case INFO_DUCKETS = "info_duckets";
    case INFO_RENTABLES = "info_rentables";
    case INFO_PETS = "info_pets";
    case ROOM_ADS = "roomads";
    case SOLD_LTD_ITEMS = "sold_ltd_items";
    case BADGE_DISPLAY = "badge_display";
    case BOTS = "bots";
    case PETS = "pets";
    case PETS_2 = "pets2";
    case PETS_3 = "pets3";
    case PRODUCT_PAGE_1 = "productpage1";
    case ROOM_BUNDLE = "room_bundle";
    case RECENT_PURCHASES = "recent_purchases";
    case DEFAULT_3X3_COLOR_GROUPING = "default_3x3_color_grouping";
    case GUILD_FORUM = "guild_forum";
    case VIP_BUY = "vip_buy";
    case INFO_LOYALITY = "info_loyalty";
    case LOYALITY_VIP_BUY = "loyalty_vip_buy";
    case COLLECTIBLES = "collectibles";
    case PET_CUSTOMIZATION = "petcustomization";
    case FRONTPAGE_FEATURED = "frontpage_featured";
}