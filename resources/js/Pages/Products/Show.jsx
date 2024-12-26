import { Link } from '@inertiajs/react';

export default function Show({ product }) {
    return (
        <div className="max-w-3xl mx-auto p-4">
            <div className="bg-white rounded-lg shadow-md p-6">
                <img
                    src={product.image}
                    alt={product.name}
                    className="w-full h-80 object-contain rounded-md mb-4"
                />
                <h1 className="text-2xl font-bold mb-2">{product.name}</h1>
                <p className="text-gray-700 mb-2">{product.description}</p>
                <p className="text-lg font-semibold text-green-600">Price: ${product.price}</p>
                <Link
                    href="/products"
                    className="text-pink-500 hover:underline mt-4 block"
                >
                    Back to All Products
                </Link>
            </div>
        </div>
    );
}
