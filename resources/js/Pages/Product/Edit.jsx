import CreateProductForm from "@/Pages/Product/Partials/CreateProductForm.jsx";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import EditProductForm from "@/Pages/Product/Partials/EditProductForm.jsx";

export default function Edit({ auth, mustVerifyEmail, status, product }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Edit Product
                </h2>
            }
        >
            <Head title="Edit product" />

            <div className="w-full">
                <div className="space-y-6 w-full">
                    <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                        <header>
                            <h2 className="text-lg font-medium text-gray-900">
                                Edit Product
                            </h2>

                            <p className="mt-1 text-sm text-gray-600">
                                Edit product details
                            </p>
                        </header>

                        <EditProductForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                            product={product}
                            className="max-w-xl"
                        />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
