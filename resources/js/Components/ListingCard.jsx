import React from 'react';

export default function ListingCard({ listing }) {
    return (
        <div className="bg-white shadow-md rounded-lg p-6 border hover:shadow-xl transition duration-200 relative">
            {Boolean(listing.is_trending) && (
                <span className="absolute top-2 right-2 bg-red-500 text-white text-xs font-semibold px-2 py-1 rounded">
                    🔥 Trending
                </span>
            )}
            <h2 className="text-xl font-semibold mb-2">{listing.title}</h2>
            <p className="text-gray-600 mb-1">📍 {listing.location}</p>
            <p className="text-gray-800 font-bold mb-2">${listing.price.toLocaleString()}</p>
            <p className="text-sm text-gray-600 italic">✨ {listing.usp}</p>
        </div>
    );
}
