@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold text-gray-800 mb-6">Admin Dashboard</h1>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Statistics Cards -->
            <x-dashboard.stats-card title="Registered Friends" :value="$stats['friends_count']" icon="icons.users" color="purple" />

            <x-dashboard.stats-card title="Available Trees" :value="$stats['available_trees']" icon="icons.tree" color="blue" />

            <x-dashboard.stats-card title="Sold Trees" :value="$stats['sold_trees']" icon="icons.check-circle" color="green" />
        </div>

        <!-- Quick Actions Dashboard -->
        <div class="container">
            <h1 class=" text-xl font-bold text-gray-800 mb-8">Quick Actions</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Manage Species Card -->
                <x-dashboard.action-card title="Manage Species" description="Manage and organize different tree species"
                    :route="route('species.index')" icon="icons.folder" color="blue" />

                <!-- Manage Trees Card -->
                <x-dashboard.action-card title="Manage Trees" description="Monitor and manage tree inventory"
                    :route="route('trees.index')" icon="icons.tree" color="green" />

                <!-- Manage Users Card -->
                <x-dashboard.action-card title="Manage Users" description="Manage administrative users" :route="route('users.index')"
                    icon="icons.users-admin" color="purple" />

                <!-- Manage Friends Card -->
                <x-dashboard.action-card title="Manage Friends" description="Manage friend accounts and trees"
                    :route="route('friends.index')" icon="icons.users" color="orange" />

            </div>
        </div>
    </div>
@endsection
