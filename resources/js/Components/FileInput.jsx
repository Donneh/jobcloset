import { forwardRef, useEffect, useRef } from "react";

export default forwardRef(function FileInput(
    { className = "", isFocused = false, ...props },
    ref
) {
    const input = ref ? ref : useRef();

    useEffect(() => {
        if (isFocused) {
            input.current.focus();
        }
    }, []);

    return (
        <input
            {...props}
            type="file"
            className={
                "block w-full border border-gray-200 shadow-sm rounded-md text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500\n" +
                "    file:bg-transparent file:border-0\n" +
                "    file:bg-gray-100 file:mr-4\n" +
                "    file:py-3 file:px-4\n" +
                className
            }
            ref={input}
        />
    );
});
