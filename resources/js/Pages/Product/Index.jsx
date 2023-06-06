import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import CreateProductForm from "@/Pages/Product/Partials/CreateProductForm.jsx";

export default function Index({ auth, products }) {
    return (
        <AuthenticatedLayout user={auth.user}>
            <Head title="Products" />

            <div className="w-full">
                <div className="space-y-6 w-full">
                    <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                        <header>
                            <h2 className="text-lg font-medium text-gray-900">
                                Products
                            </h2>

                            <p className="mt-1 text-sm text-gray-600">
                                List of products.
                            </p>
                        </header>

                        <table>
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>
                                {products.map((product) => (
                                    <tr>
                                        <td>{product.name}</td>
                                        <td>{product.price}</td>
                                        <td>{product.description}</td>
                                    </tr>
                                ))}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
