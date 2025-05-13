import GuestLayout from "@/Layouts/GuestLayout.jsx";
import ListingCard from "@/Components/ListingCard.jsx";
import Nav from "@/Components/Nav.jsx";
import {useEffect, useState} from "react";
import {Head} from "@inertiajs/react";

export default function Listings({authenticated, maxPrice, locations}) {
    const [listings, setListings] = useState([]);
    const [rawPrice, setRawPrice] = useState(maxPrice); // input slider state
    const [price, setPrice] = useState(maxPrice);       // debounced actual state
    const [location, setLocation] = useState();

    const handlePriceChange = (e) => {
        const value = e.target.value;
        setRawPrice(value);
    };

    // Debounce effect for price filter
    useEffect(() => {
        const timeout = setTimeout(() => {
            setPrice(rawPrice);
        }, 500); // Adjust debounce time as needed

        return () => clearTimeout(timeout); // Clear previous timeout
    }, [rawPrice]);

    const handleLocationClick = (newLocation) => {
        setLocation(prev => (prev === newLocation ? null : newLocation));
    };

    const fetchListings = () => {
        let filters = '';
        if (price) filters += `max_price=${price}`;
        if (location) filters += `&location=${location}`;

        fetch(`/api/v1/listings/?${filters}`)
            .then(res => res.json())
            .then(({data}) => setListings(data));
    };

    useEffect(() => {
        fetchListings();
    }, [price, location]);

    return (
        <GuestLayout nav={<Nav auth={authenticated} />}>
            <Head title="Listing" />
            <div className="max-w-5xl mx-auto px-4 py-6">
                <h1 className="text-3xl font-bold mb-8 text-center">Luxury Boats</h1>

                {/* Location Filter */}
                <div className="flex flex-wrap gap-2 mb-6">
                    {locations.map((loc) => (
                        <button
                            key={loc}
                            onClick={() => handleLocationClick(loc)}
                            className={`px-4 py-2 rounded-xl border text-sm transition ${
                                location === loc
                                    ? 'bg-blue-600 text-white border-blue-600'
                                    : 'bg-white text-gray-700 border-gray-300 hover:bg-gray-100'
                            }`}
                        >
                            {loc}
                        </button>
                    ))}
                </div>

                {/* Max Price Slider Filter */}
                <div className="mb-6">
                    <label className="block mb-1 font-semibold">
                        Max Price: ${parseInt(rawPrice || 0).toLocaleString()}
                    </label>
                    <input
                        type="range"
                        min="0"
                        max={maxPrice}
                        value={Number(rawPrice)}
                        onChange={handlePriceChange}
                        className="w-full"
                    />
                </div>

                {/* Listings */}
                <div className="grid grid-cols-1 gap-6">
                    {listings.length > 0 ? (
                        listings.map((listing) => (
                            <ListingCard key={listing.id} listing={listing}/>
                        ))
                    ) : (
                        <div className="text-center bg-white text-gray-500 py-10 rounded-lg shadow-md">
                            😕 No listings found matching your criteria.
                        </div>
                    )}
                </div>
            </div>
        </GuestLayout>
    )
};
