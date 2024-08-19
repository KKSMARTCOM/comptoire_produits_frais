namespace App\Http\Controllers\Frontend;

use App\Models\About;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class OrderController extends Controller
{
    public function submit(Request $request)
    {
        
        return redirect()->route('order.success'); 
    }
}
