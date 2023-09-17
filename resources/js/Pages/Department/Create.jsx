import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout";
import { Head } from "@inertiajs/react";
import CreateLocationForm from "@/Pages/Location/Partials/CreateLocationForm.jsx";
import CreateDepartmentForm from "@/Pages/Department/Partials/CreateDepartmentForm.jsx";

export default function Create({ auth, mustVerifyEmail, status }) {
    return (
        <AuthenticatedLayout
            user={auth.user}
            header={
                <h2 className="font-semibold text-xl text-gray-800 leading-tight">
                    Create Department
                </h2>
            }
        >
            <Head title="Create Department" />

            <div className="w-full">
                <div className="space-y-6 w-full">
                    <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                        <header>
                            <h2 className="text-lg font-medium text-gray-900">
                                Create Department
                            </h2>

                            <p className="mt-1 text-sm text-gray-600">
                                Create a new department.
                            </p>
                        </header>

                        <CreateDepartmentForm
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
