namespace App\Http\Controllers;

use App\Models\Clothing;
use Illuminate\Http\Request;

class ClothingController extends Controller
{
    public function index(Request $request)
    {
        $query = Clothing::query();

        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'size' => 'required|string',
            'color' => 'required|string',
            'image_url' => 'nullable|string',
        ]);

        $clothing = Clothing::create($request->all());

        return response()->json($clothing, 201);
    }

    public function update(Request $request, Clothing $clothing)
    {
        $clothing->update($request->all());
        return response()->json($clothing);
    }

    public function destroy(Clothing $clothing)
    {
        $clothing->delete();
        return response()->json(['message' => 'Item deleted successfully']);
    }
}
