import { Link } from '@inertiajs/react';

export default function Index({ products }) {
    return (
        <div className="max-w-4xl mx-auto p-4">
            <h1 class="text-4xl font-bold text-center text-pink-500 animate-bounce">Shop Smart</h1>
            <ul className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                {products.map((product) => (
                    <li
                        key={product.id}
                        className="border rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 bg-gradient-to-br from-white to-gray-100"
                    >
                        <img
                            src={product.image}
                            alt={product.name}
                            className="w-40 h-40 object-cover rounded-md mb-2 mx-auto"
                        />
                        <h2 className="text-xl font-semibold text-center">{product.name}</h2>
                        <p className="text-gray-700 text-center">฿{product.price}</p>
                        <Link
                            href={`/products/${product.id}`}
                            className="text-pink-500 hover:underline mt-2 block text-center"
                        >
                            View Details
                        </Link>
                    </li>
                ))}
            </ul>
        </div>
    );
}
