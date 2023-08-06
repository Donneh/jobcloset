import CreateProductForm from "@/Pages/Product/Partials/CreateProductForm.jsx";
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import CreateUserForm from "@/Pages/User/Partials/CreateUserForm.jsx";

export default function Create({ auth, mustVerifyEmail, status }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Create User
                </h2>
            }
        >
            <Head title="Create User" />

            <div className="w-full">
                <div className="space-y-6 w-full">
                    <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                        <header>
                            <h2 className="text-lg font-medium text-gray-900">
                                Create Product
                            </h2>

                            <p className="mt-1 text-sm text-gray-600">
                                Create a new user.
                            </p>
                        </header>

                        <CreateUserForm
                            mustVerifyEmail={mustVerifyEmail}
                            status={status}
                            className="max-w-xl"
                        />
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    );
}
