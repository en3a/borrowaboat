import ApplicationLogo from '@/Components/ApplicationLogo';
import { Link } from '@inertiajs/react';

export default function GuestLayout({ nav, children }) {
    return (
        <div className="flex min-h-screen flex-col items-center bg-gray-100 pt-6">
            {nav}

            <div>
                <Link href="/">
                    <ApplicationLogo className="h-20 w-20 fill-current text-gray-500" />
                </Link>
            </div>

            <div className="mt-6 w-full overflow-hidden px-6 py-4 sm:max-w-xl sm:rounded-lg">
                {children}
            </div>
        </div>
    );
}
