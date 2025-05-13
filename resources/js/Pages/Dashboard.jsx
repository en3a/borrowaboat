import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout';
import {Head} from '@inertiajs/react';
import {useState} from "react";

export default function Dashboard({listings}) {
    const [trendingMap, setTrendingMap] = useState(
        listings.reduce((acc, listing) => {
            acc[listing.id] = listing.is_trending;
            return acc;
        }, {})
    );

    const handleTrendingChange = async (id) => {
        const newValue = !trendingMap[id];
        setTrendingMap((prev) => ({...prev, [id]: newValue}));

        await fetch(`/api/v1/listings/${parseInt(id)}/trending`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-Token': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({is_trending: newValue}),
        });
    }

    return (
        <AuthenticatedLayout
            header={
                <h2 className="text-xl font-semibold leading-tight text-gray-800">
                    Dashboard
                </h2>
            }
        >
            <Head title="Dashboard"/>

            <div className="py-12">
                <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                    <div className="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                        <div className="p-6 text-gray-900">
                            <h2 className="mb-4 text-lg">All Listings</h2>
                            {listings.map((listing, index) => (
                                <div key={listing.id} className={`flex justify-between mb-4 pb-4 ${
                                    index !== listings.length - 1 ? 'border-b' : ''
                                }`}>
                                    <div>
                                        <h3 className="text-lg font-semibold">{listing.title}</h3>
                                        <p className="text-sm text-gray-500">Price: ${listing.price}</p>
                                        <p className="text-sm text-gray-500">Location: {listing.location}</p>
                                    </div>
                                    <label className="cursor-pointer">
                                        <span className="text-sm text-gray-500">Is Trending</span>
                                        <input
                                            type="checkbox"
                                            className="ml-4"
                                            checked={trendingMap[listing.id]}
                                            onChange={() => handleTrendingChange(listing.id)}
                                        />
                                    </label>
                                </div>
                            ))}
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
