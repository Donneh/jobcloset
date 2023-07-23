import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head, Link, usePage } from "@inertiajs/react";
import ProductGrid from "@/Pages/Shop/Partials/ProductGrid.jsx";
import CartButton from "@/Components/CartButton.jsx";

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
                                        <CartButton />
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
