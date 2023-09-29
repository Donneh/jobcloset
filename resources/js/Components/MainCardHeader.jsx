import CartButton from "@/Components/CartButton.jsx";

export default function MainCardHeader({ className, title, children }) {
    return (
        <header>
            <div className={"flex justify-between items-center"}>
                <h1 className="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    {title}
                </h1>

                <div>
                    <CartButton />
                </div>
            </div>

            <hr className={"my-4"} />
        </header>
    );
}
