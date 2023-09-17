import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import CreateDepartmentForm from "@/Pages/Department/Partials/CreateDepartmentForm.jsx";
import CreateLocationForm from "@/Pages/Location/Partials/CreateLocationForm.jsx";

export default function Create({ auth, mustVerifyEmail, status }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Create Location
                </h2>
            }
        >
            <Head title="Create Location" />

            <div className="w-full">
                <div className="space-y-6 w-full">
                    <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                        <header>
                            <h2 className="text-lg font-medium text-gray-900">
                                Create Location
                            </h2>

                            <p className="mt-1 text-sm text-gray-600">
                                Create a new location.
                            </p>
                        </header>

                        <CreateLocationForm
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
