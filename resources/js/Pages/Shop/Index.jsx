import { StarIcon } from "@heroicons/react/20/solid";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import ProductGrid from "@/Pages/Shop/Partials/ProductGrid.jsx";

export default function Index({ auth, products }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Shop" />

            <div className="w-full">
                <div className="space-y-6 w-full">
                    <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                        <div className="mx-auto max-w-7xl overflow-hidden sm:px-6 lg:px-8">
                            <header>
                                <h2 className="text-lg font-medium text-gray-900">
                                    Shop
                                </h2>

                                <p className="mt-1 text-sm text-gray-600">
                                    List of products.
                                </p>
                            </header>

                            <div className="mt-6">
                                <ProductGrid products={products} />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
