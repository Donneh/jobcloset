export default function MainCard({ className, children }) {
    return (
        <div className="w-full">
            <div className="space-y-6 w-full">
                <div className="p-4 sm:p-8 bg-white w-full shadow sm:rounded-lg">
                    <div className="mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {children}
                    </div>
                </div>
            </div>
        </div>
    );
}
