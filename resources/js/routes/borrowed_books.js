import BorrowedBookItem from '../components/pages/BorrowedBooks/Item.vue';
import resConf from '../res/resource-definition';

export default [
    {
        path: `/borrowed_books/:id`,
        component: BorrowedBookItem,
        meta:resConf.borrowed_books
    }
]