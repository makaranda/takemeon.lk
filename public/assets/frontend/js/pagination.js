const paginationNumbers = document.getElementById("pagination-numbers");
const paginatedList = document.getElementById("paginated-list");

const nextButton = document.getElementById("next-button");
const prevButton = document.getElementById("prev-button");

const paginationLimit = 12;
const pageCount = Math.ceil(listItems / paginationLimit);


const disableButton = (button) => {
    button.classList.add("disabled");
    button.setAttribute("disabled", true);
};

const enableButton = (button) => {
    button.classList.remove("disabled");
    button.removeAttribute("disabled");
};

const handlePageButtonsStatus = () => {
    if (currentPage === 1) {
        disableButton(prevButton);
    } else {
        enableButton(prevButton);
    }

    if (pageCount === currentPage) {
        disableButton(nextButton);
    } else {
        enableButton(nextButton);
    }
};

const handleActivePageNumber = () => {
    document.querySelectorAll(".pagination-number").forEach((button) => {
        button.classList.remove("active");
        const pageIndex = Number(button.getAttribute("page-index"));
        if (pageIndex == currentPage) {
            button.classList.add("active");
        }
    });
};

const appendPageNumber = (index) => {
    const pageNumber = document.createElement("button");
    pageNumber.className = "pagination-number";
    pageNumber.innerHTML = index;
    pageNumber.setAttribute("page-index", index);
    pageNumber.setAttribute("aria-label", "Page " + index);
    paginationNumbers.appendChild(pageNumber);
};

const setCurrentPage = (pageNum) => {
    currentPage = pageNum;
    paginationNumbers.innerHTML = ''
    handleActivePageNumber();
    handlePageButtonsStatus();

    let startPage = Math.max(1, currentPage - Math.floor(12 / 2));
    let endPage = Math.min(pageCount, startPage + 12 - 1);

    if (startPage > 1) {
        const pageNumberOne = document.createElement("button");
        pageNumberOne.className = "pagination-number";
        pageNumberOne.innerHTML = 1;
        pageNumberOne.setAttribute("page-index", 1);
        pageNumberOne.setAttribute("aria-label", "Page " + 1);
        paginationNumbers.appendChild(pageNumberOne);

        if (startPage > 2) {
            const pageNumber = document.createElement("button");
            pageNumber.className = "pagination-number";
            pageNumber.innerHTML = '...';
            pageNumber.classList.add('disabled')
            paginationNumbers.appendChild(pageNumber);
        }
    }

    if (endPage - startPage + 1 < 12) {
        startPage = Math.max(1, pageCount - 12 + 1);
    }

    for (let i = startPage; i <= endPage; i++) {
        appendPageNumber(i);
    }

    if (endPage < pageCount) {
        if (endPage < pageCount - 1) {
            const pageNumber = document.createElement("button");
            pageNumber.className = "pagination-number";
            pageNumber.innerHTML = '...';
            pageNumber.classList.add('disabled')
            paginationNumbers.appendChild(pageNumber);
        }

        const pageNumberLast = document.createElement("button");
        pageNumberLast.className = "pagination-number";
        pageNumberLast.innerHTML = pageCount;
        pageNumberLast.setAttribute("page-index", pageCount);
        pageNumberLast.setAttribute("aria-label", "Page " + pageCount);
        paginationNumbers.appendChild(pageNumberLast);
    }
    setTimeout(
        async function () {
            $.ajax({
                type: 'post',
                url: ROOT_PATH + url,
                data:  {page:pageNum},
                dataType: 'json',
                async:true,
                beforeSend: function () {
                    $("#articleLoader").removeClass('d-none');
                    $("#paginated-list").addClass('d-none');
                },
                success: function (data) {
                    $("#articleLoader").addClass('d-none');
                    $("#paginated-list").removeClass('d-none').fadeIn('show');
                    document.getElementById('paginated-list').innerHTML=data
                },
                error: function (error) {
                    console.log(JSON.stringify(error));
                },
            });
        }, 1000
    )
    navi()
};

window.addEventListener("load", () => {
    setCurrentPage(currentPage);

    prevButton.addEventListener("click", () => {
        setCurrentPage(currentPage - 1);
    });

    nextButton.addEventListener("click", () => {
        setCurrentPage(currentPage + 1);
    });
});

const navi = () => {
    document.querySelectorAll(".pagination-number").forEach((button) => {
        const pageIndex = Number(button.getAttribute("page-index"));
        if (pageIndex) {
            button.addEventListener("click", () => {
                setCurrentPage(pageIndex);
            });
        }
    });
    $("#articleLoader").removeClass('d-none');
    $("#paginated-list").addClass('d-none');
    window.scrollTo(0,0);
    handleActivePageNumber();
}