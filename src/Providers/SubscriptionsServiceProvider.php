<?php

declare(strict_types=1);

namespace Stephen\Subscriptions\Providers;

use Stephen\Subscriptions\Models\Plan;
use Illuminate\Support\ServiceProvider;
use Stephen\Support\Traits\ConsoleTools;
use Stephen\Subscriptions\Models\PlanFeature;
use Stephen\Subscriptions\Models\PlanSubscription;
use Stephen\Subscriptions\Models\PlanSubscriptionUsage;
use Stephen\Subscriptions\Console\Commands\MigrateCommand;
use Stephen\Subscriptions\Console\Commands\PublishCommand;
use Stephen\Subscriptions\Console\Commands\RollbackCommand;

class SubscriptionsServiceProvider extends ServiceProvider
{
    use ConsoleTools;

    /**
     * The commands to be registered.
     *
     * @var array
     */
    protected $commands = [
        MigrateCommand::class => 'command.stephen.subscriptions.migrate',
        PublishCommand::class => 'command.stephen.subscriptions.publish',
        RollbackCommand::class => 'command.stephen.subscriptions.rollback',
    ];

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(realpath(__DIR__.'/../../config/config.php'), 'stephen.subscriptions');

        // Bind eloquent models to IoC container
        $this->registerModels([
            'stephen.subscriptions.plan' => Plan::class,
            'stephen.subscriptions.plan_feature' => PlanFeature::class,
            'stephen.subscriptions.plan_subscription' => PlanSubscription::class,
            'stephen.subscriptions.plan_subscription_usage' => PlanSubscriptionUsage::class,
        ]);

        // Register console commands
        $this->registerCommands($this->commands);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(): void
    {
        // Publish Resources
        $this->publishesConfig('stephen/php-subscriptions');
        $this->publishesMigrations('stephen/php-subscriptions');
        ! $this->autoloadMigrations('stephen/php-subscriptions') || $this->loadMigrationsFrom(__DIR__.'/../../database/migrations');
    }
}
