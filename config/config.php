<?php

declare(strict_types=1);

return [

    // Manage autoload migrations
    'autoload_migrations' => true,

    // Subscriptions Database Tables
    'tables' => [

        'plans' => 'plans',
        'plan_features' => 'plan_features',
        'plan_subscriptions' => 'plan_subscriptions',
        'plan_subscription_usage' => 'plan_subscription_usage',

    ],

    // Subscriptions Models
    'models' => [

        'plan' => \Stephencoduor\Subscriptions\Models\Plan::class,
        'plan_feature' => \Stephencoduor\Subscriptions\Models\PlanFeature::class,
        'plan_subscription' => \Stephencoduor\Subscriptions\Models\PlanSubscription::class,
        'plan_subscription_usage' => \Stephencoduor\Subscriptions\Models\PlanSubscriptionUsage::class,

    ],

];
