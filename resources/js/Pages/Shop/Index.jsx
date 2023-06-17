import { StarIcon } from "@heroicons/react/20/solid";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link } from "@inertiajs/react";
import PrimaryButton from "@/Components/PrimaryButton.jsx";
import ProductGrid from "@/Pages/Shop/Partials/ProductGrid.jsx";
import { ShoppingBagIcon } from "@heroicons/react/24/outline/index.js";

export default function Index({ auth, products }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Shop" />

            <div className="w-full">
                <div className="space-y-6 w-full">
                    <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                        <div className="mx-auto max-w-7xl overflow-hidden sm:px-6 lg:px-8">
                            <header>
                                <div
                                    className={
                                        "flex justify-between items-center"
                                    }
                                >
                                    <h1 className="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                                        Shop
                                    </h1>

                                    <div>
                                        <button
                                            className={
                                                "relative hover:opacity-70"
                                            }
                                        >
                                            <div
                                                className={
                                                    "absolute bg-violet-700 text-white rounded-full h-5 w-5 flex justify-center items-center text-xs -right-1 top-0"
                                                }
                                            >
                                                1
                                            </div>
                                            <ShoppingBagIcon className="w-8 h-8" />
                                        </button>
                                    </div>
                                </div>
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
