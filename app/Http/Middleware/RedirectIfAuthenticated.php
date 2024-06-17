<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {
        if (Auth::check()) {
            $user = Auth::user();

            $roleRoutes = [
                'Chairman' => '/dashboard/chairman',
                'ActivitiesCommitteeMember' => '/dashboard/activitiesCommitteeMember',
                'BoardMember' => '/dashboard/boardMember',
                'HeadOfActivities' => '/dashboard/headOfActivities',
                'HeadOfMedia' => '/dashboard/headOfMedia',
                'MediaTeamMember' => '/dashboard/mediaTeamMember',
                'Secretary' => '/dashboard/secretary',
                'Treasurer' => '/dashboard/treasurer',
            ];

            foreach ($roleRoutes as $role => $route) {
                if ($user->hasRole($role)) {
                    return redirect($route);
                }
            }

            // If the user doesn't have any of the specified roles, redirect to a basic dashboard
            return redirect('/dashboard');
        }

        return $next($request);
    }
}
